<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\BoolList;
use K8Schema\Collection\IntList;
use K8Schema\Collection\StringList;

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
     * BoolValues is a non-empty list of true/false values.
     */
    private BoolList $bools;

    /**
     * IntValue is a number.
     */
    private int|null $int = null;

    /**
     * IntValues is a non-empty list of numbers.
     *
     * This is an alpha field and requires enabling the DRAListTypeAttributes feature
     * gate.
     */
    private IntList $ints;

    /**
     * StringValue is a string. Must not be longer than 64 characters.
     */
    private string|null $string = null;

    /**
     * StringValues is a non-empty list of strings. Each string must not be longer than
     * 64 characters.
     *
     * This is an alpha field and requires enabling the DRAListTypeAttributes feature
     * gate.
     */
    private StringList $strings;

    /**
     * VersionValue is a semantic version according to semver.org spec 2.0.0. Must not
     * be longer than 64 characters.
     */
    private string|null $version = null;

    /**
     * VersionValues is a non-empty list of semantic versions according to semver.org
     * spec 2.0.0. Each version string must not be longer than 64 characters.
     *
     * This is an alpha field and requires enabling the DRAListTypeAttributes feature
     * gate.
     */
    private StringList $versions;

    public function __construct()
    {
        $this->bools = new BoolList();
        $this->ints = new IntList();
        $this->strings = new StringList();
        $this->versions = new StringList();
    }

    public function bools(): BoolList
    {
        return $this->bools;
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

    public function ints(): IntList
    {
        return $this->ints;
    }

    public function setBool(bool $bool): self
    {
        $this->bool = $bool;

        return $this;
    }

    public function setBools(BoolList $bools): self
    {
        $this->bools = $bools;

        return $this;
    }

    public function setInt(int $int): self
    {
        $this->int = $int;

        return $this;
    }

    public function setInts(IntList $ints): self
    {
        $this->ints = $ints;

        return $this;
    }

    public function setString(string $string): self
    {
        $this->string = $string;

        return $this;
    }

    public function setStrings(StringList $strings): self
    {
        $this->strings = $strings;

        return $this;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function setVersions(StringList $versions): self
    {
        $this->versions = $versions;

        return $this;
    }

    public function strings(): StringList
    {
        return $this->strings;
    }

    public function versions(): StringList
    {
        return $this->versions;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'bool' => $this->bool,
            'bools' => $this->bools,
            'int' => $this->int,
            'ints' => $this->ints,
            'string' => $this->string,
            'strings' => $this->strings,
            'version' => $this->version,
            'versions' => $this->versions,
        ]);
    }
}
