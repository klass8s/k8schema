<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1beta1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringList;

/**
 * DeviceAllocationConfiguration gets embedded in an AllocationResult.
 */
class DeviceAllocationConfiguration implements JsonSerializable
{
    /**
     * Opaque provides driver-specific configuration parameters.
     */
    private OpaqueDeviceConfiguration|null $opaque = null;

    /**
     * Requests lists the names of requests where the configuration applies. If empty,
     * its applies to all requests.
     */
    private StringList $requests;

    /**
     * Source records whether the configuration comes from a class and thus is not
     * something that a normal user would have been able to set or from a claim.
     */
    private string $source;

    public function __construct(string $source)
    {
        $this->requests = new StringList();
        $this->source = $source;
    }

    public function getOpaque(): OpaqueDeviceConfiguration|null
    {
        return $this->opaque;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function requests(): StringList
    {
        return $this->requests;
    }

    public function setOpaque(OpaqueDeviceConfiguration $opaque): self
    {
        $this->opaque = $opaque;

        return $this;
    }

    public function setRequests(StringList $requests): self
    {
        $this->requests = $requests;

        return $this;
    }

    public function setSource(string $source): self
    {
        $this->source = $source;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'opaque' => $this->opaque,
            'requests' => $this->requests,
            'source' => $this->source,
        ]);
    }
}
