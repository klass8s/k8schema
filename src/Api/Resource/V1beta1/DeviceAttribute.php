<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1beta1;

use ArrayObject;
use JsonSerializable;

/**
 * DeviceAttribute must have exactly one field set.
 */
class DeviceAttribute implements JsonSerializable
{
    /**
     * BoolValue is a true/false value.
     */
    private bool|null $bool = null;

    /**
     * IntValue is a number.
     */
    private int|null $int = null;

    /**
     * StringValue is a string. Must not be longer than 64 characters.
     */
    private string|null $string = null;

    /**
     * VersionValue is a semantic version according to semver.org spec 2.0.0. Must not
     * be longer than 64 characters.
     */
    private string|null $version = null;

    public function __construct()
    {
    }

    public function getBool(): bool|null
    {
        return $this->bool;
    }

    public function getInt(): int|null
    {
        return $this->int;
    }

    public function getString(): string|null
    {
        return $this->string;
    }

    public function getVersion(): string|null
    {
        return $this->version;
    }

    public function setBool(bool $bool): self
    {
        $this->bool = $bool;

        return $this;
    }

    public function setInt(int $int): self
    {
        $this->int = $int;

        return $this;
    }

    public function setString(string $string): self
    {
        $this->string = $string;

        return $this;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'bool' => $this->bool,
            'int' => $this->int,
            'string' => $this->string,
            'version' => $this->version,
        ]);
    }
}
