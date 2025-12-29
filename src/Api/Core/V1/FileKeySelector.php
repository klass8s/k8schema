<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use JsonSerializable;

/**
 * FileKeySelector selects a key of the env file.
 */
class FileKeySelector implements JsonSerializable
{
    /**
     * The key within the env file. An invalid key will prevent the pod from starting.
     * The keys defined within a source may consist of any printable ASCII characters
     * except '='. During Alpha stage of the EnvFiles feature gate, the key size is
     * limited to 128 characters.
     */
    private string $key;

    /**
     * Specify whether the file or its key must be defined. If the file or key does not
     * exist, then the env var is not published. If optional is set to true and the
     * specified key does not exist, the environment variable will not be set in the
     * Pod's containers.
     *
     * If optional is set to false and the specified key does not exist, an error will
     * be returned during Pod creation.
     */
    private bool|null $optional = null;

    /**
     * The path within the volume from which to select the file. Must be relative and
     * may not contain the '..' path or start with '..'.
     */
    private string $path;

    /**
     * The name of the volume mount containing the env file.
     */
    private string $volumeName;

    public function __construct(string $key, string $path, string $volumeName)
    {
        $this->key = $key;
        $this->path = $path;
        $this->volumeName = $volumeName;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getOptional(): bool|null
    {
        return $this->optional;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getVolumeName(): string
    {
        return $this->volumeName;
    }

    public function setKey(string $key): self
    {
        $this->key = $key;

        return $this;
    }

    public function setOptional(bool $optional): self
    {
        $this->optional = $optional;

        return $this;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function setVolumeName(string $volumeName): self
    {
        $this->volumeName = $volumeName;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'key' => $this->key,
            'optional' => $this->optional,
            'path' => $this->path,
            'volumeName' => $this->volumeName,
        ];
    }
}
