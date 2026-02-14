<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1alpha1;

use ArrayObject;
use JsonSerializable;

/**
 * PodGroup represents a set of pods with a common scheduling policy.
 */
class PodGroup implements JsonSerializable
{
    /**
     * Name is a unique identifier for the PodGroup within the Workload. It must be a
     * DNS label. This field is immutable.
     */
    private string $name;

    /**
     * Policy defines the scheduling policy for this PodGroup.
     */
    private PodGroupPolicy $policy;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->policy = new PodGroupPolicy();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function policy(): PodGroupPolicy
    {
        return $this->policy;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'name' => $this->name,
            'policy' => $this->policy,
        ]);
    }
}
