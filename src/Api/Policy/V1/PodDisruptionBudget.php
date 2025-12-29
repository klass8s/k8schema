<?php

declare(strict_types=1);

namespace K8Schema\Api\Policy\V1;

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
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Specification of the desired behavior of the PodDisruptionBudget.
     */
    private PodDisruptionBudgetSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new PodDisruptionBudgetSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): PodDisruptionBudgetSpec
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
