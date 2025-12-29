<?php

declare(strict_types=1);

namespace K8Schema\Api\Storagemigration\V1beta1;

use JsonSerializable;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\GroupResource;

/**
 * Spec of the storage version migration.
 */
class StorageVersionMigrationSpec implements JsonSerializable
{
    /**
     * The resource that is being migrated. The migrator sends requests to the endpoint
     * serving the resource. Immutable.
     */
    private GroupResource $resource;

    public function __construct(GroupResource $resource)
    {
        $this->resource = $resource;
    }

    public function getResource(): GroupResource
    {
        return $this->resource;
    }

    public function setResource(GroupResource $resource): self
    {
        $this->resource = $resource;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'resource' => $this->resource,
        ];
    }
}
