<?php

declare(strict_types=1);

namespace K8Schema\Api\Autoscaling\V2;

use ArrayObject;
use JsonSerializable;
use K8Schema\DateTimeInterface;

/**
 * HorizontalPodAutoscalerStatus describes the current status of a horizontal pod
 * autoscaler.
 */
class HorizontalPodAutoscalerStatus implements JsonSerializable
{
    /**
     * conditions is the set of conditions required for this autoscaler to scale its
     * target, and indicates whether or not those conditions are met.
     */
    private HorizontalPodAutoscalerConditionList $conditions;

    /**
     * currentMetrics is the last read state of the metrics used by this autoscaler.
     */
    private MetricStatusList $currentMetrics;

    /**
     * currentReplicas is current number of replicas of pods managed by this
     * autoscaler, as last seen by the autoscaler.
     */
    private int|null $currentReplicas = null;

    /**
     * desiredReplicas is the desired number of replicas of pods managed by this
     * autoscaler, as last calculated by the autoscaler.
     */
    private int $desiredReplicas;

    /**
     * lastScaleTime is the last time the HorizontalPodAutoscaler scaled the number of
     * pods, used by the autoscaler to control how often the number of pods is changed.
     */
    private DateTimeInterface|null $lastScaleTime = null;

    /**
     * observedGeneration is the most recent generation observed by this autoscaler.
     */
    private int|null $observedGeneration = null;

    public function __construct(int $desiredReplicas)
    {
        $this->conditions = new HorizontalPodAutoscalerConditionList();
        $this->currentMetrics = new MetricStatusList();
        $this->desiredReplicas = $desiredReplicas;
    }

    public function conditions(): HorizontalPodAutoscalerConditionList
    {
        return $this->conditions;
    }

    public function currentMetrics(): MetricStatusList
    {
        return $this->currentMetrics;
    }

    public function getCurrentReplicas(): int|null
    {
        return $this->currentReplicas;
    }

    public function getDesiredReplicas(): int
    {
        return $this->desiredReplicas;
    }

    public function getLastScaleTime(): DateTimeInterface|null
    {
        return $this->lastScaleTime;
    }

    public function getObservedGeneration(): int|null
    {
        return $this->observedGeneration;
    }

    public function setConditions(HorizontalPodAutoscalerConditionList $conditions): self
    {
        $this->conditions = $conditions;

        return $this;
    }

    public function setCurrentMetrics(MetricStatusList $currentMetrics): self
    {
        $this->currentMetrics = $currentMetrics;

        return $this;
    }

    public function setCurrentReplicas(int $currentReplicas): self
    {
        $this->currentReplicas = $currentReplicas;

        return $this;
    }

    public function setDesiredReplicas(int $desiredReplicas): self
    {
        $this->desiredReplicas = $desiredReplicas;

        return $this;
    }

    public function setLastScaleTime(DateTimeInterface $lastScaleTime): self
    {
        $this->lastScaleTime = $lastScaleTime;

        return $this;
    }

    public function setObservedGeneration(int $observedGeneration): self
    {
        $this->observedGeneration = $observedGeneration;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'conditions' => $this->conditions,
            'currentMetrics' => $this->currentMetrics,
            'currentReplicas' => $this->currentReplicas,
            'desiredReplicas' => $this->desiredReplicas,
            'lastScaleTime' => $this->lastScaleTime,
            'observedGeneration' => $this->observedGeneration,
        ]);
    }
}
