<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1beta1;

use ArrayObject;
use JsonSerializable;

/**
 * PodGroupResourceClaim references exactly one ResourceClaim, either directly or
 * by naming a ResourceClaimTemplate which is then turned into a ResourceClaim for
 * the PodGroup.
 *
 * It adds a name to it that uniquely identifies the ResourceClaim inside the
 * PodGroup. Pods that need access to the ResourceClaim define a matching reference
 * in its own Spec.ResourceClaims. The Pod's claim must match all fields of the
 * PodGroup's claim exactly.
 */
class PodGroupResourceClaim implements JsonSerializable
{
    /**
     * name uniquely identifies this resource claim inside the PodGroup. This must be a
     * DNS_LABEL.
     */
    private string $name;

    /**
     * resourceClaimName is the name of a ResourceClaim object in the same namespace as
     * this PodGroup. The ResourceClaim will be reserved for the PodGroup instead of
     * its individual pods.
     *
     * Exactly one of ResourceClaimName and ResourceClaimTemplateName must be set.
     */
    private string|null $resourceClaimName = null;

    /**
     * resourceClaimTemplateName is the name of a ResourceClaimTemplate object in the
     * same namespace as this PodGroup.
     *
     * The template will be used to create a new ResourceClaim, which will be bound to
     * this PodGroup. When this PodGroup is deleted, the ResourceClaim will also be
     * deleted. The PodGroup name and resource name, along with a generated component,
     * will be used to form a unique name for the ResourceClaim, which will be recorded
     * in podgroup.status.resourceClaimStatuses.
     *
     * This field is immutable and no changes will be made to the corresponding
     * ResourceClaim by the control plane after creating the ResourceClaim.
     *
     * Exactly one of ResourceClaimName and ResourceClaimTemplateName must be set.
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
