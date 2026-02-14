<?php

declare(strict_types=1);

namespace K8Schema\Collection;

use ArrayObject;
use JsonSerializable;

class StringListMap implements JsonSerializable
{
    /**
     * @var ArrayObject<string, StringList>
     */
    private ArrayObject $items;

    public function __construct()
    {
        $this->clear();
    }

    public function add(string $name, StringList $value): self
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
     * @return ArrayObject<string, StringList>
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

    public function get(string $name): StringList
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
