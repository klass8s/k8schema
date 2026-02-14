<?php

declare(strict_types=1);

namespace K8Schema\Api\Admissionregistration\V1beta1;

use JsonSerializable;

class VariableList implements JsonSerializable
{
    /**
     * @var Variable[]
     */
    private array $items;

    public function __construct()
    {
        $this->clear();
    }

    public function add(Variable $value): self
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
     * @return Variable[]
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
