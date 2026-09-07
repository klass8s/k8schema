<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1beta1;

use ArrayObject;
use JsonSerializable;

/**
 * WorkloadSpec defines the desired state of a Workload.
 */
class WorkloadSpec implements JsonSerializable
{
    /**
     * compositePodGroupTemplates is the list of CompositePodGroup templates that make
     * up the Workload. The maximum number of templates is 8. This field is immutable.
     * Exactly one of CompositePodGroupTemplates and PodGroupTemplates must be set.
     *
     * This field is used only when the CompositePodGroup feature gate is enabled.
     */
    private CompositePodGroupTemplateList $compositePodGroupTemplates;

    /**
     * controllerRef is an optional reference to the controlling object, such as a
     * Deployment or Job. This field is intended for use by tools like CLIs to provide
     * a link back to the original workload definition. This field is immutable.
     */
    private TypedLocalObjectReference|null $controllerRef = null;

    /**
     * podGroupTemplates is the list of templates that make up the Workload. The
     * maximum number of templates is 8. Templates cannot be added or removed after the
     * workload is created. Existing templates may still be updated where their
     * individual fields allow it. Exactly one of CompositePodGroupTemplates and
     * PodGroupTemplates must be set.
     */
    private PodGroupTemplateList $podGroupTemplates;

    public function __construct()
    {
        $this->compositePodGroupTemplates = new CompositePodGroupTemplateList();
        $this->podGroupTemplates = new PodGroupTemplateList();
    }

    public function compositePodGroupTemplates(): CompositePodGroupTemplateList
    {
        return $this->compositePodGroupTemplates;
    }

    public function getControllerRef(): TypedLocalObjectReference|null
    {
        return $this->controllerRef;
    }

    public function podGroupTemplates(): PodGroupTemplateList
    {
        return $this->podGroupTemplates;
    }

    public function setCompositePodGroupTemplates(CompositePodGroupTemplateList $compositePodGroupTemplates): self
    {
        $this->compositePodGroupTemplates = $compositePodGroupTemplates;

        return $this;
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
            'compositePodGroupTemplates' => $this->compositePodGroupTemplates,
            'controllerRef' => $this->controllerRef,
            'podGroupTemplates' => $this->podGroupTemplates,
        ]);
    }
}
