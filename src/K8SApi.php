<?php

declare(strict_types=1);

namespace K8Schema;

use Composer\Semver\Comparator;
use Composer\Semver\VersionParser;

final readonly class K8SApi
{
    public const string VERSION = 'v1.37';

    public static function versionIsHigherThan(string $version): bool
    {
        return Comparator::greaterThan(self::VERSION, self::normalizeVersion($version));
    }

    public static function versionIsLowerThan(string $version): bool
    {
        return Comparator::lessThan(self::VERSION, self::normalizeVersion($version));
    }

    public static function versionIsEqualTo(string $version): bool
    {
        return Comparator::equalTo(self::VERSION, self::normalizeVersion($version));
    }

    public static function versionIsHigherThanOrEqualTo(string $version): bool
    {
        return Comparator::greaterThanOrEqualTo(self::VERSION, self::normalizeVersion($version));
    }

    public static function versionIsLowerThanOrEqualTo(string $version): bool
    {
        return Comparator::lessThanOrEqualTo(self::VERSION, self::normalizeVersion($version));
    }

    private static function normalizeVersion(string $version): string
    {
        static $versionParser = new VersionParser();

        try {
            return $versionParser->normalize($version);
        } catch (\Exception) {
            throw new \LogicException(sprintf('%s::VERSION contains an invalid version string "%s".', __CLASS__, self::VERSION));
        }
    }
}
