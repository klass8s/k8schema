<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1alpha1;

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
     * a link back to the original workload definition. When set, it cannot be changed.
     */
    private TypedLocalObjectReference|null $controllerRef = null;

    /**
     * PodGroups is the list of pod groups that make up the Workload. The maximum
     * number of pod groups is 8. This field is immutable.
     */
    private PodGroupList $podGroups;

    public function __construct()
    {
        $this->podGroups = new PodGroupList();
    }

    public function getControllerRef(): TypedLocalObjectReference|null
    {
        return $this->controllerRef;
    }

    public function podGroups(): PodGroupList
    {
        return $this->podGroups;
    }

    public function setControllerRef(TypedLocalObjectReference $controllerRef): self
    {
        $this->controllerRef = $controllerRef;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'controllerRef' => $this->controllerRef,
            'podGroups' => $this->podGroups,
        ]);
    }
}
