<?php

declare(strict_types=1);

namespace K8Schema\Api\Storage\V1beta1;

use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;
use K8Schema\Collection\StringMap;

/**
 * VolumeAttributesClass represents a specification of mutable volume attributes
 * defined by the CSI driver. The class can be specified during dynamic
 * provisioning of PersistentVolumeClaims, and changed in the PersistentVolumeClaim
 * spec after provisioning.
 */
class VolumeAttributesClass implements APIResourceInterface
{
    public const string API_VERSION = 'storage.k8s.io/v1beta1';
    public const string KIND = 'VolumeAttributesClass';

    /**
     * Name of the CSI driver This field is immutable.
     */
    private string $driverName;

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * parameters hold volume attributes defined by the CSI driver. These values are
     * opaque to the Kubernetes and are passed directly to the CSI driver. The
     * underlying storage provider supports changing these attributes on an existing
     * volume, however the parameters field itself is immutable. To invoke a volume
     * update, a new VolumeAttributesClass should be created with new parameters, and
     * the PersistentVolumeClaim should be updated to reference the new
     * VolumeAttributesClass.
     *
     * This field is required and must contain at least one key/value pair. The keys
     * cannot be empty, and the maximum number of parameters is 512, with a cumulative
     * max size of 256K. If the CSI driver rejects invalid parameters, the target
     * PersistentVolumeClaim will be set to an "Infeasible" state in the
     * modifyVolumeStatus field.
     */
    private StringMap $parameters;

    public function __construct(string $driverName)
    {
        $this->driverName = $driverName;
        $this->metadata = new ObjectMeta();
        $this->parameters = new StringMap();
    }

    public function getDriverName(): string
    {
        return $this->driverName;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function parameters(): StringMap
    {
        return $this->parameters;
    }

    public function setDriverName(string $driverName): self
    {
        $this->driverName = $driverName;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'driverName' => $this->driverName,
            'metadata' => $this->metadata,
            'parameters' => $this->parameters,
        ];
    }
}
