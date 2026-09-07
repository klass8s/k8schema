<?php

declare(strict_types=1);

namespace K8Schema\Api\Lifecycle\V1alpha1;

use ArrayObject;
use JsonSerializable;
use K8Schema\DateTimeInterface;

/**
 * ResponderStatus represents the last observed status of the eviction process of
 * the responder. It should be only updated by the designated responder whose name
 * is .name field.
 */
class ResponderStatus implements JsonSerializable
{
    /**
     * completionTime tracks the time at which the Responder stopped processing the
     * eviction request. Completion means that the responders has either fully or
     * partially completed the eviction process, which may have resulted in target
     * eviction (e.g. pod termination). It should reflect the present time when set.
     * This field becomes immutable once set.
     */
    private DateTimeInterface|null $completionTime = null;

    /**
     * expectedCompletionTime is the time at which the eviction process step is
     * expected to end for the responder. The time cannot be set to the past. May be
     * omitted if no estimate can be made.
     */
    private DateTimeInterface|null $expectedCompletionTime = null;

    /**
     * heartbeatTime is the last time at which the eviction process was reported to be
     * in progress by the responder. It should reflect the present time when set.
     * Responders should avoid heartbeats more frequent than 20 seconds to avoid
     * overloading the control-plane.
     */
    private DateTimeInterface|null $heartbeatTime = null;

    /**
     * message provides human-readable details about the state of the responder and the
     * eviction process. Maximum length is 4000 characters.
     */
    private string|null $message = null;

    /**
     * name allows you to identify the responder reacting to the Eviction.
     *
     * It must be a valid domain-prefixed key (such as "acme.io/foo"). This field is
     * initialized by Kubernetes and must be unique for each responder. This field is
     * required.
     */
    private string $name;

    /**
     * startTime tracks the time at which this responder was designated as active and
     * should start processing the eviction request. It should reflect the present time
     * when set. This field is initialized by Kubernetes when this responder becomes
     * active. This field becomes immutable once set.
     */
    private DateTimeInterface|null $startTime = null;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getCompletionTime(): DateTimeInterface|null
    {
        return $this->completionTime;
    }

    public function getExpectedCompletionTime(): DateTimeInterface|null
    {
        return $this->expectedCompletionTime;
    }

    public function getHeartbeatTime(): DateTimeInterface|null
    {
        return $this->heartbeatTime;
    }

    public function getMessage(): string|null
    {
        return $this->message;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStartTime(): DateTimeInterface|null
    {
        return $this->startTime;
    }

    public function setCompletionTime(DateTimeInterface $completionTime): self
    {
        $this->completionTime = $completionTime;

        return $this;
    }

    public function setExpectedCompletionTime(DateTimeInterface $expectedCompletionTime): self
    {
        $this->expectedCompletionTime = $expectedCompletionTime;

        return $this;
    }

    public function setHeartbeatTime(DateTimeInterface $heartbeatTime): self
    {
        $this->heartbeatTime = $heartbeatTime;

        return $this;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setStartTime(DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'completionTime' => $this->completionTime,
            'expectedCompletionTime' => $this->expectedCompletionTime,
            'heartbeatTime' => $this->heartbeatTime,
            'message' => $this->message,
            'name' => $this->name,
            'startTime' => $this->startTime,
        ]);
    }
}
