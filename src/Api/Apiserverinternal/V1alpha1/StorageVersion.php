<?php

declare(strict_types=1);

namespace K8Schema\Api\Apiserverinternal\V1alpha1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * Storage version of a specific resource.
 */
class StorageVersion implements APIResourceInterface
{
    public const string API_VERSION = 'internal.apiserver.k8s.io/v1alpha1';
    public const string KIND = 'StorageVersion';

    /**
     * The name is <group>.<resource>.
     */
    private ObjectMeta $metadata;

    /**
     * Spec is an empty spec. It is here to comply with Kubernetes API style.
     */
    private StorageVersionSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new StorageVersionSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): StorageVersionSpec
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
