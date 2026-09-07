<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * ModifyVolumeStatus represents the status object of ControllerModifyVolume
 * operation
 */
class ModifyVolumeStatus implements JsonSerializable
{
    /**
     * status is the status of the ControllerModifyVolume operation. It can be in any
     * of following states:
     *  - Pending
     *    Pending indicates that the PersistentVolumeClaim cannot be modified due to
     * unmet requirements, such as
     *    the specified VolumeAttributesClass not existing.
     *  - InProgress
     *    InProgress indicates that the volume is being modified.
     *  - Infeasible
     *   Infeasible indicates that the request has been rejected as invalid by the CSI
     * driver. To
     *       resolve the error, a valid VolumeAttributesClass needs to be specified.
     * Note: New statuses can be added in the future. Consumers should check for
     * unknown statuses and fail appropriately.
     */
    private string $status;

    /**
     * targetVolumeAttributesClassName is the name of the VolumeAttributesClass the PVC
     * currently being reconciled
     */
    private string|null $targetVolumeAttributesClassName = null;

    public function __construct(string $status)
    {
        $this->status = $status;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getTargetVolumeAttributesClassName(): string|null
    {
        return $this->targetVolumeAttributesClassName;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function setTargetVolumeAttributesClassName(string $targetVolumeAttributesClassName): self
    {
        $this->targetVolumeAttributesClassName = $targetVolumeAttributesClassName;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'status' => $this->status,
            'targetVolumeAttributesClassName' => $this->targetVolumeAttributesClassName,
        ]);
    }
}
