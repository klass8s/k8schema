<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringMap;

/**
 * ReplicationControllerSpec is the specification of a replication controller.
 */
class ReplicationControllerSpec implements JsonSerializable
{
    /**
     * Minimum number of seconds for which a newly created pod should be ready without
     * any of its container crashing, for it to be considered available. Defaults to 0
     * (pod will be considered available as soon as it is ready)
     */
    private int|null $minReadySeconds = null;

    /**
     * Replicas is the number of desired replicas. This is a pointer to distinguish
     * between explicit zero and unspecified. Defaults to 1. More info:
     * https://kubernetes.io/docs/concepts/workloads/controllers/replicationcontroller#what-is-a-replicationcontroller
     */
    private int|null $replicas = null;

    /**
     * Selector is a label query over pods that should match the Replicas count. If
     * Selector is empty, it is defaulted to the labels present on the Pod template.
     * Label keys and values that must match in order to be controlled by this
     * replication controller, if empty defaulted to labels on Pod template. More info:
     * https://kubernetes.io/docs/concepts/overview/working-with-objects/labels/#label-selectors
     */
    private StringMap $selector;

    /**
     * Template is the object that describes the pod that will be created if
     * insufficient replicas are detected. This takes precedence over a TemplateRef.
     * The only allowed template.spec.restartPolicy value is "Always". More info:
     * https://kubernetes.io/docs/concepts/workloads/controllers/replicationcontroller#pod-template
     */
    private PodTemplateSpec|null $template = null;

    public function __construct()
    {
        $this->selector = new StringMap();
    }

    public function getMinReadySeconds(): int|null
    {
        return $this->minReadySeconds;
    }

    public function getReplicas(): int|null
    {
        return $this->replicas;
    }

    public function getTemplate(): PodTemplateSpec|null
    {
        return $this->template;
    }

    public function selector(): StringMap
    {
        return $this->selector;
    }

    public function setMinReadySeconds(int $minReadySeconds): self
    {
        $this->minReadySeconds = $minReadySeconds;

        return $this;
    }

    public function setReplicas(int $replicas): self
    {
        $this->replicas = $replicas;

        return $this;
    }

    public function setSelector(StringMap $selector): self
    {
        $this->selector = $selector;

        return $this;
    }

    public function setTemplate(PodTemplateSpec $template): self
    {
        $this->template = $template;

        return $this;
    }

    public function template(): PodTemplateSpec
    {
        return $this->template ??= new PodTemplateSpec();
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'minReadySeconds' => $this->minReadySeconds,
            'replicas' => $this->replicas,
            'selector' => $this->selector,
            'template' => $this->template,
        ]);
    }
}
