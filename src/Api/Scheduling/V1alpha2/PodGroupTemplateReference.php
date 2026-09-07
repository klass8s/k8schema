<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1alpha2;

use ArrayObject;
use JsonSerializable;

/**
 * PodGroupTemplateReference references a PodGroup template defined in some object
 * (e.g. Workload). Exactly one reference must be set.
 */
class PodGroupTemplateReference implements JsonSerializable
{
    /**
     * Workload references the PodGroupTemplate within the Workload object that was
     * used to create the PodGroup.
     */
    private WorkloadPodGroupTemplateReference|null $workload = null;

    public function __construct()
    {
    }

    public function getWorkload(): WorkloadPodGroupTemplateReference|null
    {
        return $this->workload;
    }

    public function setWorkload(WorkloadPodGroupTemplateReference $workload): self
    {
        $this->workload = $workload;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'workload' => $this->workload,
        ]);
    }
}
