<?php

declare(strict_types=1);

namespace K8Schema\Api\Apps\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\DateTimeInterface;

/**
 * ReplicaSetCondition describes the state of a replica set at a certain point.
 */
class ReplicaSetCondition implements JsonSerializable
{
    /**
     * The last time the condition transitioned from one status to another.
     */
    private DateTimeInterface|null $lastTransitionTime = null;

    /**
     * A human readable message indicating details about the transition.
     */
    private string|null $message = null;

    /**
     * The reason for the condition's last transition.
     */
    private string|null $reason = null;

    /**
     * Status of the condition, one of True, False, Unknown.
     */
    private string $status;

    /**
     * Type of replica set condition.
     */
    private string $type;

    public function __construct(string $status, string $type)
    {
        $this->status = $status;
        $this->type = $type;
    }

    public function getLastTransitionTime(): DateTimeInterface|null
    {
        return $this->lastTransitionTime;
    }

    public function getMessage(): string|null
    {
        return $this->message;
    }

    public function getReason(): string|null
    {
        return $this->reason;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setLastTransitionTime(DateTimeInterface $lastTransitionTime): self
    {
        $this->lastTransitionTime = $lastTransitionTime;

        return $this;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function setReason(string $reason): self
    {
        $this->reason = $reason;

        return $this;
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
            'lastTransitionTime' => $this->lastTransitionTime,
            'message' => $this->message,
            'reason' => $this->reason,
            'status' => $this->status,
            'type' => $this->type,
        ]);
    }
}
