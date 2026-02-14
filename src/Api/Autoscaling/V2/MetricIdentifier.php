<?php

declare(strict_types=1);

namespace K8Schema\Api\Autoscaling\V2;

use ArrayObject;
use JsonSerializable;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\LabelSelector;

/**
 * MetricIdentifier defines the name and optionally selector for a metric
 */
class MetricIdentifier implements JsonSerializable
{
    /**
     * name is the name of the given metric
     */
    private string $name;

    /**
     * selector is the string-encoded form of a standard kubernetes label selector for
     * the given metric When set, it is passed as an additional parameter to the
     * metrics server for more specific metrics scoping. When unset, just the
     * metricName will be used to gather metrics.
     */
    private LabelSelector|null $selector = null;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function selector(): LabelSelector
    {
        return $this->selector ??= new LabelSelector();
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'name' => $this->name,
            'selector' => $this->selector,
        ]);
    }
}
