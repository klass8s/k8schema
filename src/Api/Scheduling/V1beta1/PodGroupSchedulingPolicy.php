<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1beta1;

use ArrayObject;
use JsonSerializable;

/**
 * PodGroupSchedulingPolicy defines the scheduling configuration for a PodGroup.
 * Exactly one policy must be set. The policy is chosen at creation time by setting
 * either the Basic or Gang field. The PodGroup may not change policy after
 * creation. Fields within chosen policy may be updated after creation when their
 * individual fields allow it.
 */
class PodGroupSchedulingPolicy implements JsonSerializable
{
    /**
     * basic specifies that the pods in this group should be scheduled using standard
     * Kubernetes scheduling behavior. Setting this field at group creation time opts
     * this group to basic scheduling; this field cannot be changed afterward.
     */
    private BasicSchedulingPolicy|null $basic = null;

    /**
     * gang specifies that the pods in this group should be scheduled using
     * all-or-nothing semantics. Setting this field at group creation time opts this
     * group to gang scheduling; this field cannot be set or unset afterward. The
     * minCount field within Gang scheduling policy remains mutable after group
     * creation.
     */
    private GangSchedulingPolicy|null $gang = null;

    public function __construct()
    {
    }

    public function basic(): BasicSchedulingPolicy
    {
        return $this->basic ??= new BasicSchedulingPolicy();
    }

    public function getBasic(): BasicSchedulingPolicy|null
    {
        return $this->basic;
    }

    public function getGang(): GangSchedulingPolicy|null
    {
        return $this->gang;
    }

    public function setBasic(BasicSchedulingPolicy $basic): self
    {
        $this->basic = $basic;

        return $this;
    }

    public function setGang(GangSchedulingPolicy $gang): self
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
