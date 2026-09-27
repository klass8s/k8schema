<?php

declare(strict_types=1);

namespace K8Schema;

use Composer\Semver\Comparator;
use Composer\Semver\VersionParser;

final readonly class K8SApi
{
    public const string VERSION = 'SetMe';

    public static function versionIsHigherThan(string $version): bool
    {
        return Comparator::greaterThan(self::normalizeVersion(self::VERSION), self::normalizeVersion($version));
    }

    public static function versionIsLowerThan(string $version): bool
    {
        return Comparator::lessThan(self::normalizeVersion(self::VERSION), self::normalizeVersion($version));
    }

    public static function versionIsEqualTo(string $version): bool
    {
        return Comparator::equalTo(self::normalizeVersion(self::VERSION), self::normalizeVersion($version));
    }

    public static function versionIsHigherThanOrEqualTo(string $version): bool
    {
        return Comparator::greaterThanOrEqualTo(self::normalizeVersion(self::VERSION), self::normalizeVersion($version));
    }

    public static function versionIsLowerThanOrEqualTo(string $version): bool
    {
        return Comparator::lessThanOrEqualTo(self::normalizeVersion(self::VERSION), self::normalizeVersion($version));
    }

    /**
     * Both sides normalized: {@see Comparator} compares normalized versions only, and
     * `self::VERSION` is the minor as Kubernetes spells it (`v1.35`) — passed raw, every
     * helper answered wrong on every version (`versionIsEqualTo('1.35')` was false on
     * 1.35.7; klass8s probed with `method_exists` instead; tequila/k8schema#3).
     */
    private static function normalizeVersion(string $version): string
    {
        static $versionParser = new VersionParser();

        try {
            return $versionParser->normalize($version);
        } catch (\Exception) {
            throw new \LogicException(sprintf('%s: invalid version string "%s" (%s::VERSION is "%s").', __CLASS__, $version, __CLASS__, self::VERSION));
        }
    }
}
