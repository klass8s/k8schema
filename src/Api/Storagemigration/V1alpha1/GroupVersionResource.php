<?php

declare(strict_types=1);

namespace K8Schema\Api\Storagemigration\V1alpha1;

use JsonSerializable;

/**
 * The names of the group, the version, and the resource.
 */
class GroupVersionResource implements JsonSerializable
{
    /**
     * The name of the group.
     */
    private string|null $group = null;

    /**
     * The name of the resource.
     */
    private string|null $resource = null;

    /**
     * The name of the version.
     */
    private string|null $version = null;

    public function __construct()
    {
    }

    public function getGroup(): string|null
    {
        return $this->group;
    }

    public function getResource(): string|null
    {
        return $this->resource;
    }

    public function getVersion(): string|null
    {
        return $this->version;
    }

    public function setGroup(string $group): self
    {
        $this->group = $group;

        return $this;
    }

    public function setResource(string $resource): self
    {
        $this->resource = $resource;

        return $this;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'group' => $this->group,
            'resource' => $this->resource,
            'version' => $this->version,
        ];
    }
}
