<?php

declare(strict_types=1);

namespace K8Schema\Collection;

use ArrayObject;
use JsonSerializable;

class StringMap implements JsonSerializable
{
    /**
     * @var ArrayObject<string, string>
     */
    private ArrayObject $items;

    public function __construct()
    {
        $this->clear();
    }

    public function add(string $name, string $value): self
    {
        $this->items[$name] = $value;

        return $this;
    }

    public function addAll(array $items): self
    {
        foreach ($items as $key => $value) {
            $this->add($key, $value);
        }

        return $this;
    }

    /**
     * @return ArrayObject<string, string>
     */
    public function all(): ArrayObject
    {
        return $this->items;
    }

    public function clear(): self
    {
        $this->items = new ArrayObject();

        return $this;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function get(string $name): string
    {
        return $this->items[$name];
    }

    public function has(string $name): bool
    {
        return $this->items->offsetExists($name);
    }

    public function remove(string $name): self
    {
        $this->items->offsetUnset($name);

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return $this->items;
    }
}
