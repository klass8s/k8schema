<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\DateTimeInterface;

/**
 * The device this taint is attached to has the "effect" on any claim which does
 * not tolerate the taint and, through the claim, to pods using the claim.
 */
class DeviceTaint implements JsonSerializable
{
    /**
     * The effect of the taint on claims that do not tolerate the taint and through
     * such claims on the pods using them. Valid effects are NoSchedule and NoExecute.
     * PreferNoSchedule as used for nodes is not valid here.
     */
    private string $effect;

    /**
     * The taint key to be applied to a device. Must be a label name.
     */
    private string $key;

    /**
     * TimeAdded represents the time at which the taint was added. Added automatically
     * during create or update if not set.
     */
    private DateTimeInterface|null $timeAdded = null;

    /**
     * The taint value corresponding to the taint key. Must be a label value.
     */
    private string|null $value = null;

    public function __construct(string $effect, string $key)
    {
        $this->effect = $effect;
        $this->key = $key;
    }

    public function getEffect(): string
    {
        return $this->effect;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getTimeAdded(): DateTimeInterface|null
    {
        return $this->timeAdded;
    }

    public function getValue(): string|null
    {
        return $this->value;
    }

    public function setEffect(string $effect): self
    {
        $this->effect = $effect;

        return $this;
    }

    public function setKey(string $key): self
    {
        $this->key = $key;

        return $this;
    }

    public function setTimeAdded(DateTimeInterface $timeAdded): self
    {
        $this->timeAdded = $timeAdded;

        return $this;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'effect' => $this->effect,
            'key' => $this->key,
            'timeAdded' => $this->timeAdded,
            'value' => $this->value,
        ]);
    }
}
