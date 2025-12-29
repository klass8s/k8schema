<?php

declare(strict_types=1);

namespace K8Schema\ApiextensionsApiserver\Pkg\Apis\Apiextensions\V1;

use JsonSerializable;

class SelectableFieldList implements JsonSerializable
{
    /**
     * @var SelectableField[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(SelectableField $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var SelectableField[] $items
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
     * @return SelectableField[]
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
