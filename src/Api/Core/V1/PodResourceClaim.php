<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * PodResourceClaim references exactly one ResourceClaim, either directly or by
 * naming a ResourceClaimTemplate which is then turned into a ResourceClaim for the
 * pod.
 *
 * It adds a name to it that uniquely identifies the ResourceClaim inside the Pod.
 * Containers that need access to the ResourceClaim reference it with this name.
 *
 * When the DRAWorkloadResourceClaims feature gate is enabled and this Pod belongs
 * to a PodGroup, a PodResourceClaim is matched to a PodGroupResourceClaim if all
 * of their fields are equal (Name, ResourceClaimName, and
 * ResourceClaimTemplateName). A matched claim references a single ResourceClaim
 * shared across all Pods in the PodGroup, reserved for the PodGroup in
 * ResourceClaimStatus.ReservedFor rather than for individual Pods.
 */
class PodResourceClaim implements JsonSerializable
{
    /**
     * Name uniquely identifies this resource claim inside the pod. This must be a
     * DNS_LABEL.
     */
    private string $name;

    /**
     * ResourceClaimName is the name of a ResourceClaim object in the same namespace as
     * this pod.
     *
     * Exactly one of ResourceClaimName and ResourceClaimTemplateName must be set.
     */
    private string|null $resourceClaimName = null;

    /**
     * ResourceClaimTemplateName is the name of a ResourceClaimTemplate object in the
     * same namespace as this pod.
     *
     * The template will be used to create a new ResourceClaim, which will be bound to
     * this pod. When this pod is deleted, the ResourceClaim will also be deleted. The
     * pod name and resource name, along with a generated component, will be used to
     * form a unique name for the ResourceClaim, which will be recorded in
     * pod.status.resourceClaimStatuses.
     *
     * When the DRAWorkloadResourceClaims feature gate is enabled and the pod belongs
     * to a PodGroup that defines a PodGroupResourceClaim with the same Name and
     * ResourceClaimTemplateName, this PodResourceClaim resolves to the ResourceClaim
     * generated for the PodGroup. All pods in the group that define an equivalent
     * PodResourceClaim matching the PodGroupResourceClaim's Name and
     * ResourceClaimTemplateName share the same generated ResourceClaim. ResourceClaims
     * generated for a PodGroup are owned by the PodGroup and their lifecycles are tied
     * to the PodGroup instead of any individual pod.
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
