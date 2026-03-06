<?php

declare(strict_types=1);

namespace K8Schema\Apimachinery\Pkg\Apis\Meta\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\DateTimeInterface;

/**
 * Condition contains details for one aspect of the current state of this API
 * Resource.
 */
class Condition implements JsonSerializable
{
    /**
     * lastTransitionTime is the last time the condition transitioned from one status
     * to another. This should be when the underlying condition changed.  If that is
     * not known, then using the time when the API field changed is acceptable.
     */
    private DateTimeInterface $lastTransitionTime;

    /**
     * message is a human readable message indicating details about the transition.
     * This may be an empty string.
     */
    private string $message;

    /**
     * observedGeneration represents the .metadata.generation that the condition was
     * set based upon. For instance, if .metadata.generation is currently 12, but the
     * .status.conditions[x].observedGeneration is 9, the condition is out of date with
     * respect to the current state of the instance.
     */
    private int|null $observedGeneration = null;

    /**
     * reason contains a programmatic identifier indicating the reason for the
     * condition's last transition. Producers of specific condition types may define
     * expected values and meanings for this field, and whether the values are
     * considered a guaranteed API. The value should be a CamelCase string. This field
     * may not be empty.
     */
    private string $reason;

    /**
     * status of the condition, one of True, False, Unknown.
     */
    private string $status;

    /**
     * type of condition in CamelCase or in foo.example.com/CamelCase.
     */
    private string $type;

    public function __construct(
        DateTimeInterface $lastTransitionTime,
        string $message,
        string $reason,
        string $status,
        string $type,
    ) {
        $this->lastTransitionTime = $lastTransitionTime;
        $this->message = $message;
        $this->reason = $reason;
        $this->status = $status;
        $this->type = $type;
    }

    public function getLastTransitionTime(): DateTimeInterface
    {
        return $this->lastTransitionTime;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getObservedGeneration(): int|null
    {
        return $this->observedGeneration;
    }

    public function getReason(): string
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
