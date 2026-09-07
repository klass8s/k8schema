<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * PodResourceClaimStatus is stored in the PodStatus for each PodResourceClaim
 * which references a ResourceClaimTemplate. It stores the generated name for the
 * corresponding ResourceClaim.
 */
class PodResourceClaimStatus implements JsonSerializable
{
    /**
     * Name uniquely identifies this resource claim inside the pod. This must match the
     * name of an entry in pod.spec.resourceClaims, which implies that the string must
     * be a DNS_LABEL.
     */
    private string $name;

    /**
     * ResourceClaimName is the name of the ResourceClaim that was generated for the
     * Pod in the namespace of the Pod.
     *
     * When the DRAWorkloadResourceClaims feature is enabled and the corresponding
     * PodResourceClaim matches a PodGroupResourceClaim made by the Pod's PodGroup,
     * then this is the name of the ResourceClaim generated and reserved for the
     * PodGroup.
     *
     * If this is unset, then generating a ResourceClaim was not necessary. The
     * pod.spec.resourceClaims entry can be ignored in this case.
     */
    private string|null $resourceClaimName = null;

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

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'name' => $this->name,
            'resourceClaimName' => $this->resourceClaimName,
        ]);
    }
}
