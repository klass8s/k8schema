<?php

declare(strict_types=1);

namespace K8Schema\Api\Autoscaling\V2;

use ArrayObject;
use JsonSerializable;

/**
 * ObjectMetricStatus indicates the current value of a metric describing a
 * kubernetes object (for example, hits-per-second on an Ingress object).
 */
class ObjectMetricStatus implements JsonSerializable
{
    /**
     * current contains the current value for the given metric
     */
    private MetricValueStatus $current;

    /**
     * DescribedObject specifies the descriptions of a object,such as kind,name
     * apiVersion
     */
    private CrossVersionObjectReference $describedObject;

    /**
     * metric identifies the target metric by name and selector
     */
    private MetricIdentifier $metric;

    public function __construct(CrossVersionObjectReference $describedObject, MetricIdentifier $metric)
    {
        $this->current = new MetricValueStatus();
        $this->describedObject = $describedObject;
        $this->metric = $metric;
    }

    public function current(): MetricValueStatus
    {
        return $this->current;
    }

    public function getDescribedObject(): CrossVersionObjectReference
    {
        return $this->describedObject;
    }

    public function getMetric(): MetricIdentifier
    {
        return $this->metric;
    }

    public function setCurrent(MetricValueStatus $current): self
    {
        $this->current = $current;

        return $this;
    }

    public function setDescribedObject(CrossVersionObjectReference $describedObject): self
    {
        $this->describedObject = $describedObject;

        return $this;
    }

    public function setMetric(MetricIdentifier $metric): self
    {
        $this->metric = $metric;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'current' => $this->current,
            'describedObject' => $this->describedObject,
            'metric' => $this->metric,
        ]);
    }
}
