<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1alpha2;

use ArrayObject;
use JsonSerializable;

/**
 * WorkloadSpec defines the desired state of a Workload.
 */
class WorkloadSpec implements JsonSerializable
{
    /**
     * ControllerRef is an optional reference to the controlling object, such as a
     * Deployment or Job. This field is intended for use by tools like CLIs to provide
     * a link back to the original workload definition. This field is immutable.
     */
    private TypedLocalObjectReference|null $controllerRef = null;

    /**
     * PodGroupTemplates is the list of templates that make up the Workload. The
     * maximum number of templates is 8. This field is immutable.
     */
    private PodGroupTemplateList $podGroupTemplates;

    public function __construct()
    {
        $this->podGroupTemplates = new PodGroupTemplateList();
    }

    public function getControllerRef(): TypedLocalObjectReference|null
    {
        return $this->controllerRef;
    }

    public function podGroupTemplates(): PodGroupTemplateList
    {
        return $this->podGroupTemplates;
    }

    public function setControllerRef(TypedLocalObjectReference $controllerRef): self
    {
        $this->controllerRef = $controllerRef;

        return $this;
    }

    public function setPodGroupTemplates(PodGroupTemplateList $podGroupTemplates): self
    {
        $this->podGroupTemplates = $podGroupTemplates;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'controllerRef' => $this->controllerRef,
            'podGroupTemplates' => $this->podGroupTemplates,
        ]);
    }
}
