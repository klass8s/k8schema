<?php

declare(strict_types=1);

namespace K8Schema\Api\Autoscaling\V2;

use ArrayObject;
use JsonSerializable;

/**
 * ExternalMetricStatus indicates the current value of a global metric not
 * associated with any Kubernetes object.
 */
class ExternalMetricStatus implements JsonSerializable
{
    /**
     * current contains the current value for the given metric
     */
    private MetricValueStatus $current;

    /**
     * metric identifies the target metric by name and selector
     */
    private MetricIdentifier $metric;

    public function __construct(MetricIdentifier $metric)
    {
        $this->current = new MetricValueStatus();
        $this->metric = $metric;
    }

    public function current(): MetricValueStatus
    {
        return $this->current;
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

    public function setMetric(MetricIdentifier $metric): self
    {
        $this->metric = $metric;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'current' => $this->current,
            'metric' => $this->metric,
        ]);
    }
}
