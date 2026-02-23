<?php

declare(strict_types=1);

namespace K8Schema\Api\Storagemigration\V1alpha1;

use ArrayObject;
use JsonSerializable;

/**
 * Spec of the storage version migration.
 */
class StorageVersionMigrationSpec implements JsonSerializable
{
    /**
     * The token used in the list options to get the next chunk of objects to migrate.
     * When the .status.conditions indicates the migration is "Running", users can use
     * this token to check the progress of the migration.
     */
    private string|null $continueToken = null;

    /**
     * The resource that is being migrated. The migrator sends requests to the endpoint
     * serving the resource. Immutable.
     */
    private GroupVersionResource $resource;

    public function __construct()
    {
        $this->resource = new GroupVersionResource();
    }

    public function getContinueToken(): string|null
    {
        return $this->continueToken;
    }

    public function resource(): GroupVersionResource
    {
        return $this->resource;
    }

    public function setContinueToken(string $continueToken): self
    {
        $this->continueToken = $continueToken;

        return $this;
    }

    public function setResource(GroupVersionResource $resource): self
    {
        $this->resource = $resource;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'continueToken' => $this->continueToken,
            'resource' => $this->resource,
        ]);
    }
}
