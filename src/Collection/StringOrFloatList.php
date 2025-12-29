<?php

declare(strict_types=1);

namespace K8Schema\Collection;

use JsonSerializable;

class StringOrFloatList implements JsonSerializable
{
    /**
     * @var string[]|float[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(string|float $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var string[]|float[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        foreach ($items as $value) {
            $this->add($value);
        }

        return $this;
    }

    /**
     * @return string[]|float[]
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

    public function jsonSerialize(): array
    {
        return $this->items;
    }
}
