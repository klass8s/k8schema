<?php

declare(strict_types=1);

namespace K8Schema\Api\Autoscaling\V2;

use ArrayObject;
use JsonSerializable;

/**
 * MetricValueStatus holds the current value for a metric
 */
class MetricValueStatus implements JsonSerializable
{
    /**
     * averageUtilization is the current value of the average of the resource metric
     * across all relevant pods, represented as a percentage of the requested value of
     * the resource for the pods.
     */
    private int|null $averageUtilization = null;

    /**
     * averageValue is the current value of the average of the metric across all
     * relevant pods (as a quantity)
     */
    private string|float|null $averageValue = null;

    /**
     * value is the current value of the metric (as a quantity).
     */
    private string|float|null $value = null;

    public function __construct()
    {
    }

    public function getAverageUtilization(): int|null
    {
        return $this->averageUtilization;
    }

    public function getAverageValue(): string|float|null
    {
        return $this->averageValue;
    }

    public function getValue(): string|float|null
    {
        return $this->value;
    }

    public function setAverageUtilization(int $averageUtilization): self
    {
        $this->averageUtilization = $averageUtilization;

        return $this;
    }

    public function setAverageValue(string|float $averageValue): self
    {
        $this->averageValue = $averageValue;

        return $this;
    }

    public function setValue(string|float $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'averageUtilization' => $this->averageUtilization,
            'averageValue' => $this->averageValue,
            'value' => $this->value,
        ]);
    }
}
