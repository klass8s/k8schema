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
     * apiServerID is the ID of the reporting API server.
     */
    private string $apiServerID;

    /**
     * decodableVersions are the encoding versions the API server can handle to decode.
     * The API server can decode objects encoded in these versions. The encodingVersion
     * must be included in the decodableVersions.
     */
    private StringList $decodableVersions;

    /**
     * encodingVersion the API server encodes the object to when persisting it in the
     * backend (e.g., etcd).
     */
    private string $encodingVersion;

    /**
     * servedVersions lists all versions the API server can serve. DecodableVersions
     * must include all ServedVersions.
     */
    private StringList $servedVersions;

    public function __construct(string $apiServerID, string $encodingVersion)
    {
        $this->apiServerID = $apiServerID;
        $this->decodableVersions = new StringList();
        $this->encodingVersion = $encodingVersion;
        $this->servedVersions = new StringList();
    }

    public function decodableVersions(): StringList
    {
        return $this->decodableVersions;
    }

    public function getApiServerID(): string
    {
        return $this->apiServerID;
    }

    public function getEncodingVersion(): string
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
