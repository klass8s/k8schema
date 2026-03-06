<?php

declare(strict_types=1);

namespace K8Schema\Api\Storage\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\DateTimeInterface;

/**
 * VolumeError captures an error encountered during a volume operation.
 */
class VolumeError implements JsonSerializable
{
    /**
     * errorCode is a numeric gRPC code representing the error encountered during
     * Attach or Detach operations.
     *
     * This is an optional, alpha field that requires the
     * MutableCSINodeAllocatableCount feature gate being enabled to be set.
     */
    private int|null $errorCode = null;

    /**
     * message represents the error encountered during Attach or Detach operation. This
     * string may be logged, so it should not contain sensitive information.
     */
    private string|null $message = null;

    /**
     * time represents the time the error was encountered.
     */
    private DateTimeInterface|null $time = null;

    public function __construct()
    {
    }

    public function getErrorCode(): int|null
    {
        return $this->errorCode;
    }

    public function getMessage(): string|null
    {
        return $this->message;
    }

    public function getTime(): DateTimeInterface|null
    {
        return $this->time;
    }

    public function setErrorCode(int $errorCode): self
    {
        $this->errorCode = $errorCode;

        return $this;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function setTime(DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'errorCode' => $this->errorCode,
            'message' => $this->message,
            'time' => $this->time,
        ]);
    }
}
