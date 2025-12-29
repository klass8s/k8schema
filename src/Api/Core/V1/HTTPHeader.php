<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use JsonSerializable;

/**
 * HTTPHeader describes a custom header to be used in HTTP probes
 */
class HTTPHeader implements JsonSerializable
{
    /**
     * The header field name. This will be canonicalized upon output, so case-variant
     * names will be understood as the same header.
     */
    private string $name;

    /**
     * The header field value
     */
    private string $value;

    public function __construct(string $name, string $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'value' => $this->value,
        ];
    }
}
