<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\DateTimeInterface;

/**
 * PersistentVolumeClaimCondition contains details about state of pvc
 */
class PersistentVolumeClaimCondition implements JsonSerializable
{
    /**
     * lastProbeTime is the time we probed the condition.
     */
    private DateTimeInterface|null $lastProbeTime = null;

    /**
     * lastTransitionTime is the time the condition transitioned from one status to
     * another.
     */
    private DateTimeInterface|null $lastTransitionTime = null;

    /**
     * message is the human-readable message indicating details about last transition.
     */
    private string|null $message = null;

    /**
     * reason is a unique, this should be a short, machine understandable string that
     * gives the reason for condition's last transition. If it reports "Resizing" that
     * means the underlying persistent volume is being resized.
     */
    private string|null $reason = null;

    /**
     * Status is the status of the condition. Can be True, False, Unknown. More info:
     * https://kubernetes.io/docs/reference/kubernetes-api/config-and-storage-resources/persistent-volume-claim-v1/#:~:text=state%20of%20pvc-,conditions.status,-(string)%2C%20required
     */
    private string $status;

    /**
     * Type is the type of the condition. More info:
     * https://kubernetes.io/docs/reference/kubernetes-api/config-and-storage-resources/persistent-volume-claim-v1/#:~:text=set%20to%20%27ResizeStarted%27.-,PersistentVolumeClaimCondition,-contains%20details%20about
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
