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

    public function getMessage(): string|null
    {
        return $this->message;
    }

    public function getTime(): DateTimeInterface|null
    {
        return $this->time;
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
            'message' => $this->message,
            'time' => $this->time,
        ]);
    }
}
