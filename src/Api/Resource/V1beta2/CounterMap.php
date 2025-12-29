<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1beta2;

use JsonSerializable;

class CounterMap implements JsonSerializable
{
    /**
     * @var Counter[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(string $name, Counter $value): self
    {
        $this->items[$name] = $value;

        return $this;
    }

    /**
     * @var Counter[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        foreach ($items as $key => $value) {
            $this->add($key, $value);
        }

        return $this;
    }

    /**
     * @return Counter[]
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

    public function get(string $name): Counter
    {
        return $this->items[$name];
    }

    public function has(string $name): bool
    {
        return array_key_exists($name, $this->items);
    }

    public function remove(string $name): self
    {
        unset($this->items[$name]);

        return $this;
    }

    public function jsonSerialize(): array
    {
        return $this->items;
    }
}
