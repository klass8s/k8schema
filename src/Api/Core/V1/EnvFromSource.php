<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * EnvFromSource represents the source of a set of ConfigMaps or Secrets
 */
class EnvFromSource implements JsonSerializable
{
    /**
     * The ConfigMap to select from
     */
    private ConfigMapEnvSource|null $configMapRef = null;

    /**
     * Optional text to prepend to the name of each environment variable. May consist
     * of any printable ASCII characters except '='.
     */
    private string|null $prefix = null;

    /**
     * The Secret to select from
     */
    private SecretEnvSource|null $secretRef = null;

    public function __construct()
    {
    }

    public function configMapRef(): ConfigMapEnvSource
    {
        return $this->configMapRef ??= new ConfigMapEnvSource();
    }

    public function getPrefix(): string|null
    {
        return $this->prefix;
    }

    public function secretRef(): SecretEnvSource
    {
        return $this->secretRef ??= new SecretEnvSource();
    }

    public function setPrefix(string $prefix): self
    {
        $this->prefix = $prefix;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'configMapRef' => $this->configMapRef,
            'prefix' => $this->prefix,
            'secretRef' => $this->secretRef,
        ]);
    }
}
