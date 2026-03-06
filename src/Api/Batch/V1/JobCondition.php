<?php

declare(strict_types=1);

namespace K8Schema\Api\Batch\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\DateTimeInterface;

/**
 * JobCondition describes current state of a job.
 */
class JobCondition implements JsonSerializable
{
    /**
     * Last time the condition was checked.
     */
    private DateTimeInterface|null $lastProbeTime = null;

    /**
     * Last time the condition transit from one status to another.
     */
    private DateTimeInterface|null $lastTransitionTime = null;

    /**
     * Human readable message indicating details about last transition.
     */
    private string|null $message = null;

    /**
     * (brief) reason for the condition's last transition.
     */
    private string|null $reason = null;

    /**
     * Status of the condition, one of True, False, Unknown.
     */
    private string $status;

    /**
     * Type of job condition, Complete or Failed.
     */
    private string $type;

    public function __construct(string $status, string $type)
    {
        $this->status = $status;
        $this->type = $type;
    }

    public function getLastProbeTime(): DateTimeInterface|null
    {
        return $this->lastProbeTime;
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

    public function setLastProbeTime(DateTimeInterface $lastProbeTime): self
    {
        $this->lastProbeTime = $lastProbeTime;

        return $this;
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
            'lastProbeTime' => $this->lastProbeTime,
            'lastTransitionTime' => $this->lastTransitionTime,
            'message' => $this->message,
            'reason' => $this->reason,
            'status' => $this->status,
            'type' => $this->type,
        ]);
    }
}
