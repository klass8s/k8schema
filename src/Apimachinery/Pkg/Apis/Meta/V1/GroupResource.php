<?php

declare(strict_types=1);

namespace K8Schema\Apimachinery\Pkg\Apis\Meta\V1;

use ArrayObject;
use JsonSerializable;

/**
 * GroupResource specifies a Group and a Resource, but does not force a version.
 * This is useful for identifying concepts during lookup stages without having
 * partially valid types
 */
class GroupResource implements JsonSerializable
{
    private string $group;
    private string $resource;

    public function __construct(string $group, string $resource)
    {
        $this->group = $group;
        $this->resource = $resource;
    }

    public function getGroup(): string
    {
        return $this->group;
    }

    public function getResource(): string
    {
        return $this->resource;
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

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'group' => $this->group,
            'resource' => $this->resource,
        ]);
    }
}
