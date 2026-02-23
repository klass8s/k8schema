<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringOrFloatMap;

/**
 * LimitRangeItem defines a min/max usage limit for any resource that matches on
 * kind.
 */
class LimitRangeItem implements JsonSerializable
{
    /**
     * Default resource requirement limit value by resource name if resource limit is
     * omitted.
     */
    private StringOrFloatMap $default;

    /**
     * DefaultRequest is the default resource requirement request value by resource
     * name if resource request is omitted.
     */
    private StringOrFloatMap $defaultRequest;

    /**
     * Max usage constraints on this kind by resource name.
     */
    private StringOrFloatMap $max;

    /**
     * MaxLimitRequestRatio if specified, the named resource must have a request and
     * limit that are both non-zero where limit divided by request is less than or
     * equal to the enumerated value; this represents the max burst for the named
     * resource.
     */
    private StringOrFloatMap $maxLimitRequestRatio;

    /**
     * Min usage constraints on this kind by resource name.
     */
    private StringOrFloatMap $min;

    /**
     * Type of resource that this limit applies to.
     */
    private string $type;

    public function __construct(string $type)
    {
        $this->default = new StringOrFloatMap();
        $this->defaultRequest = new StringOrFloatMap();
        $this->max = new StringOrFloatMap();
        $this->maxLimitRequestRatio = new StringOrFloatMap();
        $this->min = new StringOrFloatMap();
        $this->type = $type;
    }

    public function default(): StringOrFloatMap
    {
        return $this->default;
    }

    public function defaultRequest(): StringOrFloatMap
    {
        return $this->defaultRequest;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function max(): StringOrFloatMap
    {
        return $this->max;
    }

    public function maxLimitRequestRatio(): StringOrFloatMap
    {
        return $this->maxLimitRequestRatio;
    }

    public function min(): StringOrFloatMap
    {
        return $this->min;
    }

    public function setDefault(StringOrFloatMap $default): self
    {
        $this->default = $default;

        return $this;
    }

    public function setDefaultRequest(StringOrFloatMap $defaultRequest): self
    {
        $this->defaultRequest = $defaultRequest;

        return $this;
    }

    public function setMax(StringOrFloatMap $max): self
    {
        $this->max = $max;

        return $this;
    }

    public function setMaxLimitRequestRatio(StringOrFloatMap $maxLimitRequestRatio): self
    {
        $this->maxLimitRequestRatio = $maxLimitRequestRatio;

        return $this;
    }

    public function setMin(StringOrFloatMap $min): self
    {
        $this->min = $min;

        return $this;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'default' => $this->default,
            'defaultRequest' => $this->defaultRequest,
            'max' => $this->max,
            'maxLimitRequestRatio' => $this->maxLimitRequestRatio,
            'min' => $this->min,
            'type' => $this->type,
        ]);
    }
}
