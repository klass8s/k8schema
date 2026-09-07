<?php

declare(strict_types=1);

namespace K8Schema\Apimachinery\Pkg\Apis\Meta\V1;

use ArrayObject;
use JsonSerializable;

/**
 * ShardInfo describes the shard selector that was applied to produce a list
 * response. Its presence on a list response indicates the list is a filtered
 * subset.
 */
class ShardInfo implements JsonSerializable
{
    /**
     * selector is the shard selector string from the request, echoed back so clients
     * can verify which shard they received and merge responses from multiple shards.
     */
    private string $selector;

    public function __construct(string $selector)
    {
        $this->selector = $selector;
    }

    public function getSelector(): string
    {
        return $this->selector;
    }

    public function setSelector(string $selector): self
    {
        $this->selector = $selector;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'selector' => $this->selector,
        ]);
    }
}
