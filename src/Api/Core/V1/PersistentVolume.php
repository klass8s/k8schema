<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * PersistentVolume (PV) is a storage resource provisioned by an administrator. It
 * is analogous to a node. More info:
 * https://kubernetes.io/docs/concepts/storage/persistent-volumes
 */
class PersistentVolume implements APIResourceInterface
{
    public const string API_VERSION = 'v1';
    public const string KIND = 'PersistentVolume';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * spec defines a specification of a persistent volume owned by the cluster.
     * Provisioned by an administrator. More info:
     * https://kubernetes.io/docs/concepts/storage/persistent-volumes#persistent-volumes
     */
    private PersistentVolumeSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new PersistentVolumeSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): PersistentVolumeSpec
    {
        return $this->spec;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
            'spec' => $this->spec,
        ];
    }
}
