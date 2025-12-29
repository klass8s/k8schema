<?php

declare(strict_types=1);

namespace K8Schema\Apimachinery\Pkg\Apis\Meta\V1;

use JsonSerializable;
use K8Schema\Collection\StringList;

/**
 * FieldSelectorRequirement is a selector that contains values, a key, and an
 * operator that relates the key and values.
 */
class FieldSelectorRequirement implements JsonSerializable
{
    /**
     * key is the field selector key that the requirement applies to.
     */
    private string $key;

    /**
     * operator represents a key's relationship to a set of values. Valid operators are
     * In, NotIn, Exists, DoesNotExist. The list of operators may grow in the future.
     */
    private string $operator;

    /**
     * values is an array of string values. If the operator is In or NotIn, the values
     * array must be non-empty. If the operator is Exists or DoesNotExist, the values
     * array must be empty.
     */
    private StringList $values;

    public function __construct(string $key, string $operator)
    {
        $this->key = $key;
        $this->operator = $operator;
        $this->values = new StringList();
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getOperator(): string
    {
        return $this->operator;
    }

    public function setKey(string $key): self
    {
        $this->key = $key;

        return $this;
    }

    public function setOperator(string $operator): self
    {
        $this->operator = $operator;

        return $this;
    }

    public function values(): StringList
    {
        return $this->values;
    }

    public function jsonSerialize(): array
    {
        return [
            'key' => $this->key,
            'operator' => $this->operator,
            'values' => $this->values,
        ];
    }
}
