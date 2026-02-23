<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringOrFloatMap;

/**
 * VolumeResourceRequirements describes the storage resource requirements for a
 * volume.
 */
class VolumeResourceRequirements implements JsonSerializable
{
    /**
     * Limits describes the maximum amount of compute resources allowed. More info:
     * https://kubernetes.io/docs/concepts/configuration/manage-resources-containers/
     */
    private StringOrFloatMap $limits;

    /**
     * Requests describes the minimum amount of compute resources required. If Requests
     * is omitted for a container, it defaults to Limits if that is explicitly
     * specified, otherwise to an implementation-defined value. Requests cannot exceed
     * Limits. More info:
     * https://kubernetes.io/docs/concepts/configuration/manage-resources-containers/
     */
    private StringOrFloatMap $requests;

    public function __construct()
    {
        $this->limits = new StringOrFloatMap();
        $this->requests = new StringOrFloatMap();
    }

    public function limits(): StringOrFloatMap
    {
        return $this->limits;
    }

    public function requests(): StringOrFloatMap
    {
        return $this->requests;
    }

    public function setLimits(StringOrFloatMap $limits): self
    {
        $this->limits = $limits;

        return $this;
    }

    public function setRequests(StringOrFloatMap $requests): self
    {
        $this->requests = $requests;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'limits' => $this->limits,
            'requests' => $this->requests,
        ]);
    }
}
