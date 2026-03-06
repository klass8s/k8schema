<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * VolumeMountStatus shows status of volume mounts.
 */
class VolumeMountStatus implements JsonSerializable
{
    /**
     * MountPath corresponds to the original VolumeMount.
     */
    private string $mountPath;

    /**
     * Name corresponds to the name of the original VolumeMount.
     */
    private string $name;

    /**
     * ReadOnly corresponds to the original VolumeMount.
     */
    private bool|null $readOnly = null;

    /**
     * RecursiveReadOnly must be set to Disabled, Enabled, or unspecified (for
     * non-readonly mounts). An IfPossible value in the original VolumeMount must be
     * translated to Disabled or Enabled, depending on the mount result.
     */
    private string|null $recursiveReadOnly = null;

    public function __construct(string $mountPath, string $name)
    {
        $this->mountPath = $mountPath;
        $this->name = $name;
    }

    public function getMountPath(): string
    {
        return $this->mountPath;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getReadOnly(): bool|null
    {
        return $this->readOnly;
    }

    public function getRecursiveReadOnly(): string|null
    {
        return $this->recursiveReadOnly;
    }

    public function setMountPath(string $mountPath): self
    {
        $this->mountPath = $mountPath;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setReadOnly(bool $readOnly): self
    {
        $this->readOnly = $readOnly;

        return $this;
    }

    public function setRecursiveReadOnly(string $recursiveReadOnly): self
    {
        $this->recursiveReadOnly = $recursiveReadOnly;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'mountPath' => $this->mountPath,
            'name' => $this->name,
            'readOnly' => $this->readOnly,
            'recursiveReadOnly' => $this->recursiveReadOnly,
        ]);
    }
}
