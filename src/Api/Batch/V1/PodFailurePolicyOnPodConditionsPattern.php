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
     * Specifies the required Pod condition status. To match a pod condition it is
     * required that the specified status equals the pod condition status. Defaults to
     * True.
     */
    private string|null $status = null;

    /**
     * Specifies the required Pod condition type. To match a pod condition it is
     * required that specified type equals the pod condition type.
     */
    private string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function getStatus(): string|null
    {
        return $this->status;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'status' => $this->status,
            'type' => $this->type,
        ]);
    }
}
