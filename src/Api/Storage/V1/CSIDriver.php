<?php

declare(strict_types=1);

namespace K8Schema\Api\Storage\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * CSIDriver captures information about a Container Storage Interface (CSI) volume
 * driver deployed on the cluster. Kubernetes attach detach controller uses this
 * object to determine whether attach is required. Kubelet uses this object to
 * determine whether pod information needs to be passed on mount. CSIDriver objects
 * are non-namespaced.
 */
class CSIDriver implements APIResourceInterface
{
    public const string API_VERSION = 'storage.k8s.io/v1';
    public const string KIND = 'CSIDriver';

    /**
     * Standard object metadata. metadata.Name indicates the name of the CSI driver
     * that this object refers to; it MUST be the same name returned by the CSI
     * GetPluginName() call for that driver. The driver name must be 63 characters or
     * less, beginning and ending with an alphanumeric character ([a-z0-9A-Z]) with
     * dashes (-), dots (.), and alphanumerics between. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * spec represents the specification of the CSI Driver.
     */
    private CSIDriverSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new CSIDriverSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setMetadata(ObjectMeta $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    public function setSpec(CSIDriverSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function spec(): CSIDriverSpec
    {
        return $this->spec;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
            'spec' => $this->spec,
        ]);
    }
}
