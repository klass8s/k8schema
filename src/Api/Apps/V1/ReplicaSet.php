<?php

declare(strict_types=1);

namespace K8Schema\Api\Apps\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * ReplicaSet ensures that a specified number of pod replicas are running at any
 * given time.
 */
class ReplicaSet implements APIResourceInterface
{
    public const string API_VERSION = 'apps/v1';
    public const string KIND = 'ReplicaSet';

    /**
     * If the Labels of a ReplicaSet are empty, they are defaulted to be the same as
     * the Pod(s) that the ReplicaSet manages. Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Spec defines the specification of the desired behavior of the ReplicaSet. More
     * info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private ReplicaSetSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new ReplicaSetSpec();
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

    public function setSpec(ReplicaSetSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function spec(): ReplicaSetSpec
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
