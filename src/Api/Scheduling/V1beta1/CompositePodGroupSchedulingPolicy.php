<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1beta1;

use ArrayObject;
use JsonSerializable;

/**
 * CompositePodGroupSchedulingPolicy defines the scheduling configuration for a
 * CompositePodGroup. Exactly one policy must be set.
 */
class CompositePodGroupSchedulingPolicy implements JsonSerializable
{
    /**
     * basic specifies that the groups of this composite group should be scheduled
     * independently. This field is immutable.
     */
    private CompositeBasicSchedulingPolicy|null $basic = null;

    /**
     * gang specifies that the groups of this composite group should be scheduled using
     * all-or-nothing semantics.
     */
    private CompositeGangSchedulingPolicy|null $gang = null;

    public function __construct()
    {
    }

    public function basic(): CompositeBasicSchedulingPolicy
    {
        return $this->basic ??= new CompositeBasicSchedulingPolicy();
    }

    public function getBasic(): CompositeBasicSchedulingPolicy|null
    {
        return $this->basic;
    }

    public function getGang(): CompositeGangSchedulingPolicy|null
    {
        return $this->gang;
    }

    public function setBasic(CompositeBasicSchedulingPolicy $basic): self
    {
        $this->basic = $basic;

        return $this;
    }

    public function setGang(CompositeGangSchedulingPolicy $gang): self
    {
        $this->gang = $gang;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'basic' => $this->basic,
            'gang' => $this->gang,
        ]);
    }
}
