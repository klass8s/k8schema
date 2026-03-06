<?php

declare(strict_types=1);

namespace K8Schema\ApiextensionsApiserver\Pkg\Apis\Apiextensions\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\DateTimeInterface;

/**
 * CustomResourceDefinitionCondition contains details for the current condition of
 * this pod.
 */
class CustomResourceDefinitionCondition implements JsonSerializable
{
    /**
     * lastTransitionTime last time the condition transitioned from one status to
     * another.
     */
    private DateTimeInterface|null $lastTransitionTime = null;

    /**
     * message is a human-readable message indicating details about last transition.
     */
    private string|null $message = null;

    /**
     * observedGeneration represents the .metadata.generation that the condition was
     * set based upon. For instance, if .metadata.generation is currently 12, but the
     * .status.conditions[x].observedGeneration is 9, the condition is out of date with
     * respect to the current state of the instance.
     */
    private int|null $observedGeneration = null;

    /**
     * reason is a unique, one-word, CamelCase reason for the condition's last
     * transition.
     */
    private string|null $reason = null;

    /**
     * status is the status of the condition. Can be True, False, Unknown.
     */
    private string $status;

    /**
     * type is the type of the condition. Types include Established, NamesAccepted and
     * Terminating.
     */
    private string $type;

    public function __construct(string $status, string $type)
    {
        $this->status = $status;
        $this->type = $type;
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
            'lastTransitionTime' => $this->lastTransitionTime,
            'message' => $this->message,
            'observedGeneration' => $this->observedGeneration,
            'reason' => $this->reason,
            'status' => $this->status,
            'type' => $this->type,
        ]);
    }
}
