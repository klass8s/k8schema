<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringMap;

/**
 * Represents storage that is managed by an external CSI volume driver
 */
class CSIPersistentVolumeSource implements JsonSerializable
{
    /**
     * controllerExpandSecretRef is a reference to the secret object containing
     * sensitive information to pass to the CSI driver to complete the CSI
     * ControllerExpandVolume call. This field is optional, and may be empty if no
     * secret is required. If the secret object contains more than one secret, all
     * secrets are passed.
     */
    private SecretReference|null $controllerExpandSecretRef = null;

    /**
     * controllerPublishSecretRef is a reference to the secret object containing
     * sensitive information to pass to the CSI driver to complete the CSI
     * ControllerPublishVolume and ControllerUnpublishVolume calls. This field is
     * optional, and may be empty if no secret is required. If the secret object
     * contains more than one secret, all secrets are passed.
     */
    private SecretReference|null $controllerPublishSecretRef = null;

    /**
     * driver is the name of the driver to use for this volume. Required.
     */
    private string $driver;

    /**
     * fsType to mount. Must be a filesystem type supported by the host operating
     * system. Ex. "ext4", "xfs", "ntfs".
     */
    private string|null $fsType = null;

    /**
     * nodeExpandSecretRef is a reference to the secret object containing sensitive
     * information to pass to the CSI driver to complete the CSI NodeExpandVolume call.
     * This field is optional, may be omitted if no secret is required. If the secret
     * object contains more than one secret, all secrets are passed.
     */
    private SecretReference|null $nodeExpandSecretRef = null;

    /**
     * nodePublishSecretRef is a reference to the secret object containing sensitive
     * information to pass to the CSI driver to complete the CSI NodePublishVolume and
     * NodeUnpublishVolume calls. This field is optional, and may be empty if no secret
     * is required. If the secret object contains more than one secret, all secrets are
     * passed.
     */
    private SecretReference|null $nodePublishSecretRef = null;

    /**
     * nodeStageSecretRef is a reference to the secret object containing sensitive
     * information to pass to the CSI driver to complete the CSI NodeStageVolume and
     * NodeStageVolume and NodeUnstageVolume calls. This field is optional, and may be
     * empty if no secret is required. If the secret object contains more than one
     * secret, all secrets are passed.
     */
    private SecretReference|null $nodeStageSecretRef = null;

    /**
     * readOnly value to pass to ControllerPublishVolumeRequest. Defaults to false
     * (read/write).
     */
    private bool|null $readOnly = null;

    /**
     * volumeAttributes of the volume to publish.
     */
    private StringMap $volumeAttributes;

    /**
     * volumeHandle is the unique volume name returned by the CSI volume plugin’s
     * CreateVolume to refer to the volume on all subsequent calls. Required.
     */
    private string $volumeHandle;

    public function __construct(string $driver, string $volumeHandle)
    {
        $this->driver = $driver;
        $this->volumeAttributes = new StringMap();
        $this->volumeHandle = $volumeHandle;
    }

    public function controllerExpandSecretRef(): SecretReference
    {
        return $this->controllerExpandSecretRef ??= new SecretReference();
    }

    public function controllerPublishSecretRef(): SecretReference
    {
        return $this->controllerPublishSecretRef ??= new SecretReference();
    }

    public function getDriver(): string
    {
        return $this->driver;
    }

    public function getFsType(): string|null
    {
        return $this->fsType;
    }

    public function getReadOnly(): bool|null
    {
        return $this->readOnly;
    }

    public function getVolumeHandle(): string
    {
        return $this->volumeHandle;
    }

    public function nodeExpandSecretRef(): SecretReference
    {
        return $this->nodeExpandSecretRef ??= new SecretReference();
    }

    public function nodePublishSecretRef(): SecretReference
    {
        return $this->nodePublishSecretRef ??= new SecretReference();
    }

    public function nodeStageSecretRef(): SecretReference
    {
        return $this->nodeStageSecretRef ??= new SecretReference();
    }

    public function setDriver(string $driver): self
    {
        $this->driver = $driver;

        return $this;
    }

    public function setFsType(string $fsType): self
    {
        $this->fsType = $fsType;

        return $this;
    }

    public function setReadOnly(bool $readOnly): self
    {
        $this->readOnly = $readOnly;

        return $this;
    }

    public function setVolumeHandle(string $volumeHandle): self
    {
        $this->volumeHandle = $volumeHandle;

        return $this;
    }

    public function volumeAttributes(): StringMap
    {
        return $this->volumeAttributes;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'controllerExpandSecretRef' => $this->controllerExpandSecretRef,
            'controllerPublishSecretRef' => $this->controllerPublishSecretRef,
            'driver' => $this->driver,
            'fsType' => $this->fsType,
            'nodeExpandSecretRef' => $this->nodeExpandSecretRef,
            'nodePublishSecretRef' => $this->nodePublishSecretRef,
            'nodeStageSecretRef' => $this->nodeStageSecretRef,
            'readOnly' => $this->readOnly,
            'volumeAttributes' => $this->volumeAttributes,
            'volumeHandle' => $this->volumeHandle,
        ]);
    }
}
