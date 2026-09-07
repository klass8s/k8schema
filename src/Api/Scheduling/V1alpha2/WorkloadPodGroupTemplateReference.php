<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1alpha2;

use ArrayObject;
use JsonSerializable;

/**
 * WorkloadPodGroupTemplateReference references the PodGroupTemplate within the
 * Workload object.
 */
class WorkloadPodGroupTemplateReference implements JsonSerializable
{
    /**
     * PodGroupTemplateName defines the PodGroupTemplate name within the Workload
     * object.
     */
    private string $podGroupTemplateName;

    /**
     * WorkloadName defines the name of the Workload object.
     */
    private string $workloadName;

    public function __construct(string $podGroupTemplateName, string $workloadName)
    {
        $this->podGroupTemplateName = $podGroupTemplateName;
        $this->workloadName = $workloadName;
    }

    public function getPodGroupTemplateName(): string
    {
        return $this->podGroupTemplateName;
    }

    public function getWorkloadName(): string
    {
        return $this->workloadName;
    }

    public function setPodGroupTemplateName(string $podGroupTemplateName): self
    {
        $this->podGroupTemplateName = $podGroupTemplateName;

        return $this;
    }

    public function setWorkloadName(string $workloadName): self
    {
        $this->workloadName = $workloadName;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'podGroupTemplateName' => $this->podGroupTemplateName,
            'workloadName' => $this->workloadName,
        ]);
    }
}
