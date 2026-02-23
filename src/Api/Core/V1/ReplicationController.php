<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * ReplicationController represents the configuration of a replication controller.
 */
class ReplicationController implements APIResourceInterface
{
    public const string API_VERSION = 'v1';
    public const string KIND = 'ReplicationController';

    /**
     * If the Labels of a ReplicationController are empty, they are defaulted to be the
     * same as the Pod(s) that the replication controller manages. Standard object's
     * metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Spec defines the specification of the desired behavior of the replication
     * controller. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private ReplicationControllerSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new ReplicationControllerSpec();
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

    public function setSpec(ReplicationControllerSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function spec(): ReplicationControllerSpec
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
