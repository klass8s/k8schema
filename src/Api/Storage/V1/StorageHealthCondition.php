<?php

declare(strict_types=1);

namespace K8Schema\Api\Storage\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\DateTimeInterface;

/**
 * StorageHealthCondition represents an adverse health condition reported by a CSI
 * driver for its storage backend on a node.
 */
class StorageHealthCondition implements JsonSerializable
{
    /**
     * accessMode is the access mode affected. Nil means all access modes are affected.
     */
    private string|null $accessMode = null;

    /**
     * lastTransitionTime is when this condition first appeared at its current state.
     */
    private DateTimeInterface|null $lastTransitionTime = null;

    /**
     * message is a human-readable description. Maximum permitted length of a message
     * is 1024 characters.
     */
    private string|null $message = null;

    /**
     * reason is a brief CamelCase machine-parseable reason. Maximum permitted length
     * of a reason is 256 characters.
     */
    private string $reason;

    /**
     * status is the health status category. One of "StorageUnreachable",
     * "StorageDegraded".
     */
    private string $status;

    /**
     * volumeMode is the volume mode affected. Nil means both are affected.
     */
    private string|null $volumeMode = null;

    public function __construct(string $reason, string $status)
    {
        $this->reason = $reason;
        $this->status = $status;
    }

    public function getAccessMode(): string|null
    {
        return $this->accessMode;
    }

    public function getLastTransitionTime(): DateTimeInterface|null
    {
        return $this->lastTransitionTime;
    }

    public function getMessage(): string|null
    {
        return $this->message;
    }

    public function getReason(): string
    {
        return $this->reason;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getVolumeMode(): string|null
    {
        return $this->volumeMode;
    }

    public function setAccessMode(string $accessMode): self
    {
        $this->accessMode = $accessMode;

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

    public function setVolumeMode(string $volumeMode): self
    {
        $this->volumeMode = $volumeMode;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'accessMode' => $this->accessMode,
            'lastTransitionTime' => $this->lastTransitionTime,
            'message' => $this->message,
            'reason' => $this->reason,
            'status' => $this->status,
            'volumeMode' => $this->volumeMode,
        ]);
    }
}
