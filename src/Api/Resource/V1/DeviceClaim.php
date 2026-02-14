<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1;

use ArrayObject;
use JsonSerializable;

/**
 * DeviceClaim defines how to request devices with a ResourceClaim.
 */
class DeviceClaim implements JsonSerializable
{
    /**
     * This field holds configuration for multiple potential drivers which could
     * satisfy requests in this claim. It is ignored while allocating the claim.
     */
    private DeviceClaimConfigurationList $config;

    /**
     * These constraints must be satisfied by the set of devices that get allocated for
     * the claim.
     */
    private DeviceConstraintList $constraints;

    /**
     * Requests represent individual requests for distinct devices which must all be
     * satisfied. If empty, nothing needs to be allocated.
     */
    private DeviceRequestList $requests;

    public function __construct()
    {
        $this->config = new DeviceClaimConfigurationList();
        $this->constraints = new DeviceConstraintList();
        $this->requests = new DeviceRequestList();
    }

    public function config(): DeviceClaimConfigurationList
    {
        return $this->config;
    }

    public function constraints(): DeviceConstraintList
    {
        return $this->constraints;
    }

    public function requests(): DeviceRequestList
    {
        return $this->requests;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'config' => $this->config,
            'constraints' => $this->constraints,
            'requests' => $this->requests,
        ]);
    }
}
