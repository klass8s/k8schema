<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1beta1;

use ArrayObject;
use JsonSerializable;

/**
 * ResourceClaimStatus tracks whether the resource has been allocated and what the
 * result of that was.
 */
class ResourceClaimStatus implements JsonSerializable
{
    /**
     * Allocation is set once the claim has been allocated successfully.
     */
    private AllocationResult|null $allocation = null;

    /**
     * Devices contains the status of each device allocated for this claim, as reported
     * by the driver. This can include driver-specific information. Entries are owned
     * by their respective drivers.
     */
    private AllocatedDeviceStatusList $devices;

    /**
     * ReservedFor indicates which entities are currently allowed to use the claim. A
     * Pod which references a ResourceClaim which is not reserved for that Pod will not
     * be started. A claim that is in use or might be in use because it has been
     * reserved must not get deallocated.
     *
     * In a cluster with multiple scheduler instances, two pods might get scheduled
     * concurrently by different schedulers. When they reference the same ResourceClaim
     * which already has reached its maximum number of consumers, only one pod can be
     * scheduled.
     *
     * Both schedulers try to add their pod to the claim.status.reservedFor field, but
     * only the update that reaches the API server first gets stored. The other one
     * fails with an error and the scheduler which issued it knows that it must put the
     * pod back into the queue, waiting for the ResourceClaim to become usable again.
     *
     * There can be at most 256 such reservations. This may get increased in the
     * future, but not reduced.
     */
    private ResourceClaimConsumerReferenceList $reservedFor;

    public function __construct()
    {
        $this->devices = new AllocatedDeviceStatusList();
        $this->reservedFor = new ResourceClaimConsumerReferenceList();
    }

    public function allocation(): AllocationResult
    {
        return $this->allocation ??= new AllocationResult();
    }

    public function devices(): AllocatedDeviceStatusList
    {
        return $this->devices;
    }

    public function getAllocation(): AllocationResult|null
    {
        return $this->allocation;
    }

    public function reservedFor(): ResourceClaimConsumerReferenceList
    {
        return $this->reservedFor;
    }

    public function setAllocation(AllocationResult $allocation): self
    {
        $this->allocation = $allocation;

        return $this;
    }

    public function setDevices(AllocatedDeviceStatusList $devices): self
    {
        $this->devices = $devices;

        return $this;
    }

    public function setReservedFor(ResourceClaimConsumerReferenceList $reservedFor): self
    {
        $this->reservedFor = $reservedFor;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'allocation' => $this->allocation,
            'devices' => $this->devices,
            'reservedFor' => $this->reservedFor,
        ]);
    }
}
