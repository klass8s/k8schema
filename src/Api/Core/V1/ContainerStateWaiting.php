<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * ContainerStateWaiting is a waiting state of a container.
 */
class ContainerStateWaiting implements JsonSerializable
{
    /**
     * Message regarding why the container is not yet running.
     */
    private string|null $message = null;

    /**
     * (brief) reason the container is not yet running.
     */
    private string|null $reason = null;

    public function __construct()
    {
    }

    public function getMessage(): string|null
    {
        return $this->message;
    }

    public function getReason(): string|null
    {
        return $this->reason;
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

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'message' => $this->message,
            'reason' => $this->reason,
        ]);
    }
}
