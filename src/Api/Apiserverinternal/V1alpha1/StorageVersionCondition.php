<?php

declare(strict_types=1);

namespace K8Schema\Api\Apiserverinternal\V1alpha1;

use ArrayObject;
use JsonSerializable;
use K8Schema\DateTimeInterface;

/**
 * Describes the state of the storageVersion at a certain point.
 */
class StorageVersionCondition implements JsonSerializable
{
    /**
     * lastTransitionTime is the last time the condition transitioned from one status
     * to another.
     */
    private DateTimeInterface|null $lastTransitionTime = null;

    /**
     * message is a human readable string indicating details about the transition.
     */
    private string $message;

    /**
     * observedGeneration represents the .metadata.generation that the condition was
     * set based upon, if field is set.
     */
    private int|null $observedGeneration = null;

    /**
     * reason for the condition's last transition.
     */
    private string $reason;

    /**
     * status of the condition, one of True, False, Unknown.
     */
    private string $status;

    /**
     * type of the condition.
     */
    private string $type;

    public function __construct(string $message, string $reason, string $status, string $type)
    {
        $this->message = $message;
        $this->reason = $reason;
        $this->status = $status;
        $this->type = $type;
    }

    public function getLastTransitionTime(): DateTimeInterface|null
    {
        return $this->lastTransitionTime;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getObservedGeneration(): int|null
    {
        return $this->observedGeneration;
    }

    public function getReason(): string
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

    public function setObservedGeneration(int $observedGeneration): self
    {
        $this->observedGeneration = $observedGeneration;

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
            'observedGeneration' => $this->observedGeneration,
            'reason' => $this->reason,
            'status' => $this->status,
            'type' => $this->type,
        ]);
    }
}
