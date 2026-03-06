<?php

declare(strict_types=1);

namespace K8Schema\Api\Autoscaling\V2;

use ArrayObject;
use JsonSerializable;

/**
 * ResourceMetricStatus indicates the current value of a resource metric known to
 * Kubernetes, as specified in requests and limits, describing each pod in the
 * current scale target (e.g. CPU or memory).  Such metrics are built in to
 * Kubernetes, and have special scaling options on top of those available to normal
 * per-pod metrics using the "pods" source.
 */
class ResourceMetricStatus implements JsonSerializable
{
    /**
     * current contains the current value for the given metric
     */
    private MetricValueStatus $current;

    /**
     * name is the name of the resource in question.
     */
    private string $name;

    public function __construct(string $name)
    {
        $this->current = new MetricValueStatus();
        $this->name = $name;
    }

    public function current(): MetricValueStatus
    {
        return $this->current;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setCurrent(MetricValueStatus $current): self
    {
        $this->current = $current;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'current' => $this->current,
            'name' => $this->name,
        ]);
    }
}
