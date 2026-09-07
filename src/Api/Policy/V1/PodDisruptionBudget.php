<?php

declare(strict_types=1);

namespace K8Schema\Api\Policy\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * PodDisruptionBudget is an object to define the max disruption that can be caused
 * to a collection of pods
 */
class PodDisruptionBudget implements APIResourceInterface
{
    public const string API_VERSION = 'policy/v1';
    public const string KIND = 'PodDisruptionBudget';

    /**
     * metadata is the standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * spec is the specification of the desired behavior of the PodDisruptionBudget.
     */
    private PodDisruptionBudgetSpec $spec;

    /**
     * status is the most recently observed status of the PodDisruptionBudget.
     */
    private PodDisruptionBudgetStatus|null $status = null;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new PodDisruptionBudgetSpec();
    }

    public function getStatus(): PodDisruptionBudgetStatus|null
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

    public function setSpec(PodDisruptionBudgetSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function setStatus(PodDisruptionBudgetStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function spec(): PodDisruptionBudgetSpec
    {
        return $this->spec;
    }

    public function status(): PodDisruptionBudgetStatus
    {
        return $this->status ??= new PodDisruptionBudgetStatus();
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
