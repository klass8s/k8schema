<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use JsonSerializable;

/**
 * ConfigMapEnvSource selects a ConfigMap to populate the environment variables
 * with.
 *
 * The contents of the target ConfigMap's Data field will represent the key-value
 * pairs as environment variables.
 */
class ConfigMapEnvSource implements JsonSerializable
{
    /**
     * Name of the referent. This field is effectively required, but due to backwards
     * compatibility is allowed to be empty. Instances of this type with an empty value
     * here are almost certainly wrong. More info:
     * https://kubernetes.io/docs/concepts/overview/working-with-objects/names/#names
     */
    private string|null $name = null;

    /**
     * Specify whether the ConfigMap must be defined
     */
    private bool|null $optional = null;

    public function __construct()
    {
    }

    public function getName(): string|null
    {
        return $this->name;
    }

    public function getOptional(): bool|null
    {
        return $this->optional;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setOptional(bool $optional): self
    {
        $this->optional = $optional;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'optional' => $this->optional,
        ];
    }
}
