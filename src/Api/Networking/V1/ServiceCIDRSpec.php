<?php

declare(strict_types=1);

namespace K8Schema\Api\Networking\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringList;

/**
 * ServiceCIDRSpec define the CIDRs the user wants to use for allocating ClusterIPs
 * for Services.
 */
class ServiceCIDRSpec implements JsonSerializable
{
    /**
     * cidrs defines the IP blocks in CIDR notation (e.g. "192.168.0.0/24" or
     * "2001:db8::/64") from which to assign service cluster IPs. Max of two CIDRs is
     * allowed, one of each IP family. This field is immutable.
     */
    private StringList $cidrs;

    public function __construct()
    {
        $this->cidrs = new StringList();
    }

    public function cidrs(): StringList
    {
        return $this->cidrs;
    }

    public function setCidrs(StringList $cidrs): self
    {
        $this->cidrs = $cidrs;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'cidrs' => $this->cidrs,
        ]);
    }
}
