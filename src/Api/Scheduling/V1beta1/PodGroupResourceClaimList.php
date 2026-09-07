<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1beta1;

use JsonSerializable;

class PodGroupResourceClaimList implements JsonSerializable
{
    /**
     * @var PodGroupResourceClaim[]
     */
    private array $items;

    public function __construct()
    {
        $this->clear();
    }

    public function add(PodGroupResourceClaim $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    public function addAll(array $items): self
    {
        foreach ($items as $value) {
            $this->add($value);
        }

        return $this;
    }

    /**
     * @return PodGroupResourceClaim[]
     */
    public function all(): array
    {
        return $this->items;
    }

    public function clear(): self
    {
        $this->items = [];

        return $this;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function jsonSerialize(): array|null
    {
        return count($this->items) > 0 ? $this->items : null;
    }
}
