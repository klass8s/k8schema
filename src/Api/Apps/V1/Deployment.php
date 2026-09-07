<?php

declare(strict_types=1);

namespace K8Schema\Api\Apps\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * Deployment enables declarative updates for Pods and ReplicaSets.
 */
class Deployment implements APIResourceInterface
{
    public const string API_VERSION = 'apps/v1';
    public const string KIND = 'Deployment';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Specification of the desired behavior of the Deployment.
     */
    private DeploymentSpec $spec;

    /**
     * Most recently observed status of the Deployment.
     */
    private DeploymentStatus|null $status = null;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new DeploymentSpec();
    }

    public function getStatus(): DeploymentStatus|null
    {
        return $this->status;
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

    public function setSpec(DeploymentSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function setStatus(DeploymentStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function spec(): DeploymentSpec
    {
        return $this->spec;
    }

    public function status(): DeploymentStatus
    {
        return $this->status ??= new DeploymentStatus();
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
            'spec' => $this->spec,
            'status' => $this->status,
        ]);
    }
}
