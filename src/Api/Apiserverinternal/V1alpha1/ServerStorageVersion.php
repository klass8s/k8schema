<?php

declare(strict_types=1);

namespace K8Schema\Api\Apiserverinternal\V1alpha1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringList;

/**
 * An API server instance reports the version it can decode and the version it
 * encodes objects to when persisting objects in the backend.
 */
class ServerStorageVersion implements JsonSerializable
{
    /**
     * The ID of the reporting API server.
     */
    private string|null $apiServerID = null;

    /**
     * The API server can decode objects encoded in these versions. The encodingVersion
     * must be included in the decodableVersions.
     */
    private StringList $decodableVersions;

    /**
     * The API server encodes the object to this version when persisting it in the
     * backend (e.g., etcd).
     */
    private string|null $encodingVersion = null;

    /**
     * The API server can serve these versions. DecodableVersions must include all
     * ServedVersions.
     */
    private StringList $servedVersions;

    public function __construct()
    {
        $this->decodableVersions = new StringList();
        $this->servedVersions = new StringList();
    }

    public function decodableVersions(): StringList
    {
        return $this->decodableVersions;
    }

    public function getApiServerID(): string|null
    {
        return $this->apiServerID;
    }

    public function getEncodingVersion(): string|null
    {
        return $this->encodingVersion;
    }

    public function servedVersions(): StringList
    {
        return $this->servedVersions;
    }

    public function setApiServerID(string $apiServerID): self
    {
        $this->apiServerID = $apiServerID;

        return $this;
    }

    public function setDecodableVersions(StringList $decodableVersions): self
    {
        $this->decodableVersions = $decodableVersions;

        return $this;
    }

    public function setEncodingVersion(string $encodingVersion): self
    {
        $this->encodingVersion = $encodingVersion;

        return $this;
    }

    public function setServedVersions(StringList $servedVersions): self
    {
        $this->servedVersions = $servedVersions;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'apiServerID' => $this->apiServerID,
            'decodableVersions' => $this->decodableVersions,
            'encodingVersion' => $this->encodingVersion,
            'servedVersions' => $this->servedVersions,
        ]);
    }
}
