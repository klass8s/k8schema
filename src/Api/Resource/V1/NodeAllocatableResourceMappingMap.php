<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1;

use ArrayObject;
use JsonSerializable;

class NodeAllocatableResourceMappingMap implements JsonSerializable
{
    /**
     * @var ArrayObject<string, NodeAllocatableResourceMapping>
     */
    private ArrayObject $items;

    public function __construct()
    {
        $this->clear();
    }

    public function add(string $name, NodeAllocatableResourceMapping $value): self
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
     * @return ArrayObject<string, NodeAllocatableResourceMapping>
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

    public function get(string $name): NodeAllocatableResourceMapping
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

    public function jsonSerialize(): ArrayObject|null
    {
        return $this->items->count() > 0 ? $this->items : null;
    }
}
