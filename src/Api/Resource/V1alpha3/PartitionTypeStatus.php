<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1alpha3;

use ArrayObject;
use JsonSerializable;

/**
 * PartitionTypeStatus reports allocatability for a single partition type,
 * identified by the value of a grouping attribute.
 */
class PartitionTypeStatus implements JsonSerializable
{
    /**
     * Allocatable is the number of additional devices of this partition type that
     * could still be allocated given current shared-counter consumption.
     */
    private int $allocatable;

    /**
     * Attribute is the fully qualified name of the device attribute whose value groups
     * this entry. It is the PartitionTypeAttribute declared by the devices' own slice,
     * or the default named in the request when their slice declares none.
     */
    private string $attribute;

    /**
     * Total is the number of devices of this partition type in the pool.
     */
    private int $total;

    /**
     * Type is the partition type value (e.g. "Full" or "Half").
     */
    private string $type;

    public function __construct(int $allocatable, string $attribute, int $total, string $type)
    {
        $this->allocatable = $allocatable;
        $this->attribute = $attribute;
        $this->total = $total;
        $this->type = $type;
    }

    public function getAllocatable(): int
    {
        return $this->allocatable;
    }

    public function getAttribute(): string
    {
        return $this->attribute;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setAllocatable(int $allocatable): self
    {
        $this->allocatable = $allocatable;

        return $this;
    }

    public function setAttribute(string $attribute): self
    {
        $this->attribute = $attribute;

        return $this;
    }

    public function setTotal(int $total): self
    {
        $this->total = $total;

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
            'allocatable' => $this->allocatable,
            'attribute' => $this->attribute,
            'total' => $this->total,
            'type' => $this->type,
        ]);
    }
}
