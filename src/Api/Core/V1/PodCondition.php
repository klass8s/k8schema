<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\DateTimeInterface;

/**
 * PodCondition contains details for the current condition of this pod.
 */
class PodCondition implements JsonSerializable
{
    /**
     * Last time we probed the condition.
     */
    private DateTimeInterface|null $lastProbeTime = null;

    /**
     * Last time the condition transitioned from one status to another.
     */
    private DateTimeInterface|null $lastTransitionTime = null;

    /**
     * Human-readable message indicating details about last transition.
     */
    private string|null $message = null;

    /**
     * If set, this represents the .metadata.generation that the pod condition was set
     * based upon. The PodObservedGenerationTracking feature gate must be enabled to
     * use this field.
     */
    private int|null $observedGeneration = null;

    /**
     * Unique, one-word, CamelCase reason for the condition's last transition.
     */
    private string|null $reason = null;

    /**
     * Status is the status of the condition. Can be True, False, Unknown. More info:
     * https://kubernetes.io/docs/concepts/workloads/pods/pod-lifecycle#pod-conditions
     */
    private string $status;

    /**
     * Type is the type of the condition. More info:
     * https://kubernetes.io/docs/concepts/workloads/pods/pod-lifecycle#pod-conditions
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

    public function getObservedGeneration(): int|null
    {
        return $this->observedGeneration;
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
            'lastProbeTime' => $this->lastProbeTime,
            'lastTransitionTime' => $this->lastTransitionTime,
            'message' => $this->message,
            'observedGeneration' => $this->observedGeneration,
            'reason' => $this->reason,
            'status' => $this->status,
            'type' => $this->type,
        ]);
    }
}
