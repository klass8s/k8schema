<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * LimitRangeSpec defines a min/max usage limit for resources that match on kind.
 */
class LimitRangeSpec implements JsonSerializable
{
    /**
     * Limits is the list of LimitRangeItem objects that are enforced.
     */
    private LimitRangeItemList $limits;

    public function __construct()
    {
        $this->limits = new LimitRangeItemList();
    }

    public function limits(): LimitRangeItemList
    {
        return $this->limits;
    }

    public function setLimits(LimitRangeItemList $limits): self
    {
        $this->limits = $limits;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'limits' => $this->limits,
        ]);
    }
}
