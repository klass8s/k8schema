<?php

declare(strict_types=1);

namespace K8Schema\Api\Autoscaling\V2;

use ArrayObject;
use JsonSerializable;

/**
 * MetricStatus describes the last-read state of a single metric.
 */
class MetricStatus implements JsonSerializable
{
    /**
     * container resource refers to a resource metric (such as those specified in
     * requests and limits) known to Kubernetes describing a single container in each
     * pod in the current scale target (e.g. CPU or memory). Such metrics are built in
     * to Kubernetes, and have special scaling options on top of those available to
     * normal per-pod metrics using the "pods" source.
     */
    private ContainerResourceMetricStatus|null $containerResource = null;

    /**
     * external refers to a global metric that is not associated with any Kubernetes
     * object. It allows autoscaling based on information coming from components
     * running outside of cluster (for example length of queue in cloud messaging
     * service, or QPS from loadbalancer running outside of cluster).
     */
    private ExternalMetricStatus|null $external = null;

    /**
     * object refers to a metric describing a single kubernetes object (for example,
     * hits-per-second on an Ingress object).
     */
    private ObjectMetricStatus|null $object = null;

    /**
     * pods refers to a metric describing each pod in the current scale target (for
     * example, transactions-processed-per-second).  The values will be averaged
     * together before being compared to the target value.
     */
    private PodsMetricStatus|null $pods = null;

    /**
     * resource refers to a resource metric (such as those specified in requests and
     * limits) known to Kubernetes describing each pod in the current scale target
     * (e.g. CPU or memory). Such metrics are built in to Kubernetes, and have special
     * scaling options on top of those available to normal per-pod metrics using the
     * "pods" source.
     */
    private ResourceMetricStatus|null $resource = null;

    /**
     * type is the type of metric source.  It will be one of "ContainerResource",
     * "External", "Object", "Pods" or "Resource", each corresponds to a matching field
     * in the object.
     */
    private string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function getContainerResource(): ContainerResourceMetricStatus|null
    {
        return $this->containerResource;
    }

    public function getExternal(): ExternalMetricStatus|null
    {
        return $this->external;
    }

    public function getObject(): ObjectMetricStatus|null
    {
        return $this->object;
    }

    public function getPods(): PodsMetricStatus|null
    {
        return $this->pods;
    }

    public function getResource(): ResourceMetricStatus|null
    {
        return $this->resource;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setContainerResource(ContainerResourceMetricStatus $containerResource): self
    {
        $this->containerResource = $containerResource;

        return $this;
    }

    public function setExternal(ExternalMetricStatus $external): self
    {
        $this->external = $external;

        return $this;
    }

    public function setObject(ObjectMetricStatus $object): self
    {
        $this->object = $object;

        return $this;
    }

    public function setPods(PodsMetricStatus $pods): self
    {
        $this->pods = $pods;

        return $this;
    }

    public function setResource(ResourceMetricStatus $resource): self
    {
        $this->resource = $resource;

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
            'containerResource' => $this->containerResource,
            'external' => $this->external,
            'object' => $this->object,
            'pods' => $this->pods,
            'resource' => $this->resource,
            'type' => $this->type,
        ]);
    }
}
