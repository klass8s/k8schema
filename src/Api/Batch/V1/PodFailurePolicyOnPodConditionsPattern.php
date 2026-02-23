<?php

declare(strict_types=1);

namespace K8Schema\Api\Batch\V1;

use ArrayObject;
use JsonSerializable;

/**
 * PodFailurePolicyOnPodConditionsPattern describes a pattern for matching an
 * actual pod condition type.
 */
class PodFailurePolicyOnPodConditionsPattern implements JsonSerializable
{
    /**
     * Specifies the required Pod condition type. To match a pod condition it is
     * required that specified type equals the pod condition type.
     */
    private string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'type' => $this->type,
        ]);
    }
}
