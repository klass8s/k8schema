<?php

declare(strict_types=1);

namespace K8Schema\Api\Storagemigration\V1beta1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * StorageVersionMigration represents a migration of stored data to the latest
 * storage version.
 */
class StorageVersionMigration implements APIResourceInterface
{
    public const string API_VERSION = 'storagemigration.k8s.io/v1beta1';
    public const string KIND = 'StorageVersionMigration';

    /**
     * Standard object metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Specification of the migration.
     */
    private StorageVersionMigrationSpec $spec;

    /**
     * Status of the migration.
     */
    private StorageVersionMigrationStatus|null $status = null;

    public function __construct(StorageVersionMigrationSpec $spec)
    {
        $this->metadata = new ObjectMeta();
        $this->spec = $spec;
    }

    public function getSpec(): StorageVersionMigrationSpec
    {
        return $this->spec;
    }

    public function getStatus(): StorageVersionMigrationStatus|null
    {
        return $this->status;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setMetadata(ObjectMeta $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    public function setSpec(StorageVersionMigrationSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function setStatus(StorageVersionMigrationStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function status(): StorageVersionMigrationStatus
    {
        return $this->status ??= new StorageVersionMigrationStatus();
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
            'spec' => $this->spec,
            'status' => $this->status,
        ]);
    }
}
