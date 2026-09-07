<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1beta1;

use ArrayObject;
use JsonSerializable;

/**
 * WorkloadReference references the Workload object together with the template that
 * was used to create a particular PodGroup.
 */
class WorkloadReference implements JsonSerializable
{
    /**
     * templateName is the name of a template within the Workload object that was used
     * to create a pod group. It must be a DNS label. This field is required.
     */
    private string $templateName;

    /**
     * workloadName is the name of the Workload object that contains a template that
     * was used when creating a pod group. It must be a DNS name. This field is
     * required.
     */
    private string $workloadName;

    public function __construct(string $templateName, string $workloadName)
    {
        $this->templateName = $templateName;
        $this->workloadName = $workloadName;
    }

    public function getTemplateName(): string
    {
        return $this->templateName;
    }

    public function getWorkloadName(): string
    {
        return $this->workloadName;
    }

    public function setTemplateName(string $templateName): self
    {
        $this->templateName = $templateName;

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
            'templateName' => $this->templateName,
            'workloadName' => $this->workloadName,
        ]);
    }
}
