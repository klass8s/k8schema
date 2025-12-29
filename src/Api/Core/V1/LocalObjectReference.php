<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use JsonSerializable;

/**
 * LocalObjectReference contains enough information to let you locate the
 * referenced object inside the same namespace.
 */
class LocalObjectReference implements JsonSerializable
{
    /**
     * Name of the referent. This field is effectively required, but due to backwards
     * compatibility is allowed to be empty. Instances of this type with an empty value
     * here are almost certainly wrong. More info:
     * https://kubernetes.io/docs/concepts/overview/working-with-objects/names/#names
     */
    private string|null $name = null;

    public function __construct()
    {
    }

    public function getName(): string|null
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
