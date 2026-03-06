<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\DateTimeInterface;

/**
 * ContainerStateTerminated is a terminated state of a container.
 */
class ContainerStateTerminated implements JsonSerializable
{
    /**
     * Container's ID in the format '<type>://<container_id>'
     */
    private string|null $containerID = null;

    /**
     * Exit status from the last termination of the container
     */
    private int $exitCode;

    /**
     * Time at which the container last terminated
     */
    private DateTimeInterface|null $finishedAt = null;

    /**
     * Message regarding the last termination of the container
     */
    private string|null $message = null;

    /**
     * (brief) reason from the last termination of the container
     */
    private string|null $reason = null;

    /**
     * Signal from the last termination of the container
     */
    private int|null $signal = null;

    /**
     * Time at which previous execution of the container started
     */
    private DateTimeInterface|null $startedAt = null;

    public function __construct(int $exitCode)
    {
        $this->exitCode = $exitCode;
    }

    public function getContainerID(): string|null
    {
        return $this->containerID;
    }

    public function getExitCode(): int
    {
        return $this->exitCode;
    }

    public function getFinishedAt(): DateTimeInterface|null
    {
        return $this->finishedAt;
    }

    public function getMessage(): string|null
    {
        return $this->message;
    }

    public function getReason(): string|null
    {
        return $this->reason;
    }

    public function getSignal(): int|null
    {
        return $this->signal;
    }

    public function getStartedAt(): DateTimeInterface|null
    {
        return $this->startedAt;
    }

    public function setContainerID(string $containerID): self
    {
        $this->containerID = $containerID;

        return $this;
    }

    public function setExitCode(int $exitCode): self
    {
        $this->exitCode = $exitCode;

        return $this;
    }

    public function setFinishedAt(DateTimeInterface $finishedAt): self
    {
        $this->finishedAt = $finishedAt;

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

    public function setSignal(int $signal): self
    {
        $this->signal = $signal;

        return $this;
    }

    public function setStartedAt(DateTimeInterface $startedAt): self
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'containerID' => $this->containerID,
            'exitCode' => $this->exitCode,
            'finishedAt' => $this->finishedAt,
            'message' => $this->message,
            'reason' => $this->reason,
            'signal' => $this->signal,
            'startedAt' => $this->startedAt,
        ]);
    }
}
