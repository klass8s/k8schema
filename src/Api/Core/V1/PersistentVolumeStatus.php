<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\DateTimeInterface;

/**
 * PersistentVolumeStatus is the current status of a persistent volume.
 */
class PersistentVolumeStatus implements JsonSerializable
{
    /**
     * lastPhaseTransitionTime is the time the phase transitioned from one to another
     * and automatically resets to current time everytime a volume phase transitions.
     */
    private DateTimeInterface|null $lastPhaseTransitionTime = null;

    /**
     * message is a human-readable message indicating details about why the volume is
     * in this state.
     */
    private string|null $message = null;

    /**
     * phase indicates if a volume is available, bound to a claim, or released by a
     * claim. More info:
     * https://kubernetes.io/docs/concepts/storage/persistent-volumes#phase
     */
    private string|null $phase = null;

    /**
     * reason is a brief CamelCase string that describes any failure and is meant for
     * machine parsing and tidy display in the CLI.
     */
    private string|null $reason = null;

    public function __construct()
    {
    }

    public function getLastPhaseTransitionTime(): DateTimeInterface|null
    {
        return $this->lastPhaseTransitionTime;
    }

    public function getMessage(): string|null
    {
        return $this->message;
    }

    public function getPhase(): string|null
    {
        return $this->phase;
    }

    public function getReason(): string|null
    {
        return $this->reason;
    }

    public function setLastPhaseTransitionTime(DateTimeInterface $lastPhaseTransitionTime): self
    {
        $this->lastPhaseTransitionTime = $lastPhaseTransitionTime;

        return $this;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function setPhase(string $phase): self
    {
        $this->phase = $phase;

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
            'lastPhaseTransitionTime' => $this->lastPhaseTransitionTime,
            'message' => $this->message,
            'phase' => $this->phase,
            'reason' => $this->reason,
        ]);
    }
}
