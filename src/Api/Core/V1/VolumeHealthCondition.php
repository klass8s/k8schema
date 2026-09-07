<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * VolumeHealthCondition represents an adverse health condition reported for a
 * volume.
 */
class VolumeHealthCondition implements JsonSerializable
{
    /**
     * message is a human-readable description. Maximum permitted length of a message
     * is 1024 bytes.
     */
    private string|null $message = null;

    /**
     * reason is a brief CamelCase machine-parseable reason. Together with status it
     * forms the unique identity of a condition entry. Maximum permitted length of a
     * reason is 256 bytes.
     */
    private string $reason;

    /**
     * status is the machine-parseable health category. Possible values: -
     * "Inaccessible": the volume cannot be accessed. - "DataLoss": data loss has been
     * detected on the volume. - "Degraded": the volume is functioning with reduced
     * capability.
     */
    private string $status;

    public function __construct(string $reason, string $status)
    {
        $this->reason = $reason;
        $this->status = $status;
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

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'message' => $this->message,
            'reason' => $this->reason,
            'status' => $this->status,
        ]);
    }
}
