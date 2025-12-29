<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1beta2;

use JsonSerializable;

/**
 * ExactDeviceRequest is a request for one or more identical devices.
 */
class ExactDeviceRequest implements JsonSerializable
{
    /**
     * AdminAccess indicates that this is a claim for administrative access to the
     * device(s). Claims with AdminAccess are expected to be used for monitoring or
     * other management services for a device.  They ignore all ordinary claims to the
     * device with respect to access modes and any resource allocations.
     *
     * This is an alpha field and requires enabling the DRAAdminAccess feature gate.
     * Admin access is disabled if this field is unset or set to false, otherwise it is
     * enabled.
     */
    private bool|null $adminAccess = null;

    /**
     * AllocationMode and its related fields define how devices are allocated to
     * satisfy this request. Supported values are:
     *
     * - ExactCount: This request is for a specific number of devices.
     *   This is the default. The exact number is provided in the
     *   count field.
     *
     * - All: This request is for all of the matching devices in a pool.
     *   At least one device must exist on the node for the allocation to succeed.
     *   Allocation will fail if some devices are already allocated,
     *   unless adminAccess is requested.
     *
     * If AllocationMode is not specified, the default mode is ExactCount. If the mode
     * is ExactCount and count is not specified, the default count is one. Any other
     * requests must specify this field.
     *
     * More modes may get added in the future. Clients must refuse to handle requests
     * with unknown modes.
     */
    private string|null $allocationMode = null;

    /**
     * Count is used only when the count mode is "ExactCount". Must be greater than
     * zero. If AllocationMode is ExactCount and this field is not specified, the
     * default is one.
     */
    private int|null $count = null;

    /**
     * DeviceClassName references a specific DeviceClass, which can define additional
     * configuration and selectors to be inherited by this request.
     *
     * A DeviceClassName is required.
     *
     * Administrators may use this to restrict which devices may get requested by only
     * installing classes with selectors for permitted devices. If users are free to
     * request anything without restrictions, then administrators can create an empty
     * DeviceClass for users to reference.
     */
    private string $deviceClassName;

    /**
     * Selectors define criteria which must be satisfied by a specific device in order
     * for that device to be considered for this request. All selectors must be
     * satisfied for a device to be considered.
     */
    private DeviceSelectorList $selectors;

    /**
     * If specified, the request's tolerations.
     *
     * Tolerations for NoSchedule are required to allocate a device which has a taint
     * with that effect. The same applies to NoExecute.
     *
     * In addition, should any of the allocated devices get tainted with NoExecute
     * after allocation and that effect is not tolerated, then all pods consuming the
     * ResourceClaim get deleted to evict them. The scheduler will not let new pods
     * reserve the claim while it has these tainted devices. Once all pods are evicted,
     * the claim will get deallocated.
     *
     * The maximum number of tolerations is 16.
     *
     * This is an alpha field and requires enabling the DRADeviceTaints feature gate.
     */
    private DeviceTolerationList $tolerations;

    public function __construct(string $deviceClassName)
    {
        $this->deviceClassName = $deviceClassName;
        $this->selectors = new DeviceSelectorList();
        $this->tolerations = new DeviceTolerationList();
    }

    public function getAdminAccess(): bool|null
    {
        return $this->adminAccess;
    }

    public function getAllocationMode(): string|null
    {
        return $this->allocationMode;
    }

    public function getCount(): int|null
    {
        return $this->count;
    }

    public function getDeviceClassName(): string
    {
        return $this->deviceClassName;
    }

    public function selectors(): DeviceSelectorList
    {
        return $this->selectors;
    }

    public function setAdminAccess(bool $adminAccess): self
    {
        $this->adminAccess = $adminAccess;

        return $this;
    }

    public function setAllocationMode(string $allocationMode): self
    {
        $this->allocationMode = $allocationMode;

        return $this;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
    }

    public function setDeviceClassName(string $deviceClassName): self
    {
        $this->deviceClassName = $deviceClassName;

        return $this;
    }

    public function tolerations(): DeviceTolerationList
    {
        return $this->tolerations;
    }

    public function jsonSerialize(): array
    {
        return [
            'adminAccess' => $this->adminAccess,
            'allocationMode' => $this->allocationMode,
            'count' => $this->count,
            'deviceClassName' => $this->deviceClassName,
            'selectors' => $this->selectors,
            'tolerations' => $this->tolerations,
        ];
    }
}
