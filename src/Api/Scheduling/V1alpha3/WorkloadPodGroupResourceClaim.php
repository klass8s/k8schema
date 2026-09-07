<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1alpha3;

use ArrayObject;
use JsonSerializable;

/**
 * WorkloadPodGroupResourceClaim references a dynamic resource claim that is shared
 * across pods in the group.
 */
class WorkloadPodGroupResourceClaim implements JsonSerializable
{
    /**
     * name uniquely identifies this resource claim inside the group. This field is
     * required. It must be a DNS_LABEL.
     */
    private string $name;

    /**
     * resourceClaimName is the name of a ResourceClaim object in the same namespace.
     * This field is optional. If it is not specified, no resource claim is used. If
     * set, it must be a DNS subdomain.
     */
    private string|null $resourceClaimName = null;

    /**
     * resourceClaimTemplateName is the name of a ResourceClaimTemplate object in the
     * same namespace. This field is optional. If it is not specified, no resource
     * claim template is used. If set, it must be a DNS subdomain.
     */
    private string|null $resourceClaimTemplateName = null;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getResourceClaimName(): string|null
    {
        return $this->resourceClaimName;
    }

    public function getResourceClaimTemplateName(): string|null
    {
        return $this->resourceClaimTemplateName;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setResourceClaimName(string $resourceClaimName): self
    {
        $this->resourceClaimName = $resourceClaimName;

        return $this;
    }

    public function setResourceClaimTemplateName(string $resourceClaimTemplateName): self
    {
        $this->resourceClaimTemplateName = $resourceClaimTemplateName;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'name' => $this->name,
            'resourceClaimName' => $this->resourceClaimName,
            'resourceClaimTemplateName' => $this->resourceClaimTemplateName,
        ]);
    }
}
