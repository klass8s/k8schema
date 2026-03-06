<?php

declare(strict_types=1);

namespace K8Schema\Api\Apiserverinternal\V1alpha1;

use ArrayObject;
use JsonSerializable;

/**
 * API server instances report the versions they can decode and the version they
 * encode objects to when persisting objects in the backend.
 */
class StorageVersionStatus implements JsonSerializable
{
    /**
     * If all API server instances agree on the same encoding storage version, then
     * this field is set to that version. Otherwise this field is left empty. API
     * servers should finish updating its storageVersionStatus entry before serving
     * write operations, so that this field will be in sync with the reality.
     */
    private string|null $commonEncodingVersion = null;

    /**
     * The latest available observations of the storageVersion's state.
     */
    private StorageVersionConditionList $conditions;

    /**
     * The reported versions per API server instance.
     */
    private ServerStorageVersionList $storageVersions;

    public function __construct()
    {
        $this->conditions = new StorageVersionConditionList();
        $this->storageVersions = new ServerStorageVersionList();
    }

    public function conditions(): StorageVersionConditionList
    {
        return $this->conditions;
    }

    public function getCommonEncodingVersion(): string|null
    {
        return $this->commonEncodingVersion;
    }

    public function setCommonEncodingVersion(string $commonEncodingVersion): self
    {
        $this->commonEncodingVersion = $commonEncodingVersion;

        return $this;
    }

    public function setConditions(StorageVersionConditionList $conditions): self
    {
        $this->conditions = $conditions;

        return $this;
    }

    public function setStorageVersions(ServerStorageVersionList $storageVersions): self
    {
        $this->storageVersions = $storageVersions;

        return $this;
    }

    public function storageVersions(): ServerStorageVersionList
    {
        return $this->storageVersions;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'commonEncodingVersion' => $this->commonEncodingVersion,
            'conditions' => $this->conditions,
            'storageVersions' => $this->storageVersions,
        ]);
    }
}
