<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * DownwardAPIVolumeFile represents information to create the file containing the
 * pod field
 */
class DownwardAPIVolumeFile implements JsonSerializable
{
    /**
     * Required: Selects a field of the pod: only annotations, labels, name, namespace
     * and uid are supported.
     */
    private ObjectFieldSelector|null $fieldRef = null;

    /**
     * Optional: mode bits used to set permissions on this file, must be an octal value
     * between 0000 and 0777 or a decimal value between 0 and 511. YAML accepts both
     * octal and decimal values, JSON requires decimal values for mode bits. If not
     * specified, the volume defaultMode will be used. This might be in conflict with
     * other options that affect the file mode, like fsGroup, and the result can be
     * other mode bits set.
     */
    private int|null $mode = null;

    /**
     * Required: Path is  the relative path name of the file to be created. Must not be
     * absolute or contain the '..' path. Must be utf-8 encoded. The first item of the
     * relative path must not start with '..'
     */
    private string $path;

    /**
     * Selects a resource of the container: only resources limits and requests
     * (limits.cpu, limits.memory, requests.cpu and requests.memory) are currently
     * supported.
     */
    private ResourceFieldSelector|null $resourceFieldRef = null;

    /**
     * user is Optional: The owner UID of the created file. If specified, the
     * item-level user field takes precedence over defaultUser. (Alpha) This field
     * requires the AtomicWriteVolumeUserFields feature gate to be enabled.
     */
    private int|null $user = null;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function getFieldRef(): ObjectFieldSelector|null
    {
        return $this->fieldRef;
    }

    public function getMode(): int|null
    {
        return $this->mode;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getResourceFieldRef(): ResourceFieldSelector|null
    {
        return $this->resourceFieldRef;
    }

    public function getUser(): int|null
    {
        return $this->user;
    }

    public function setFieldRef(ObjectFieldSelector $fieldRef): self
    {
        $this->fieldRef = $fieldRef;

        return $this;
    }

    public function setMode(int $mode): self
    {
        $this->mode = $mode;

        return $this;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function setResourceFieldRef(ResourceFieldSelector $resourceFieldRef): self
    {
        $this->resourceFieldRef = $resourceFieldRef;

        return $this;
    }

    public function setUser(int $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'fieldRef' => $this->fieldRef,
            'mode' => $this->mode,
            'path' => $this->path,
            'resourceFieldRef' => $this->resourceFieldRef,
            'user' => $this->user,
        ]);
    }
}
