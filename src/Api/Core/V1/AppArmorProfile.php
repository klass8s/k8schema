<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * AppArmorProfile defines a pod or container's AppArmor settings.
 */
class AppArmorProfile implements JsonSerializable
{
    /**
     * localhostProfile indicates a profile loaded on the node that should be used. The
     * profile must be preconfigured on the node to work. Must match the loaded name of
     * the profile. Must be set if and only if type is "Localhost".
     */
    private string|null $localhostProfile = null;

    /**
     * type indicates which kind of AppArmor profile will be applied. Valid options
     * are:
     *   Localhost - a profile pre-loaded on the node.
     *   RuntimeDefault - the container runtime's default profile.
     *   Unconfined - no AppArmor enforcement.
     */
    private string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function getLocalhostProfile(): string|null
    {
        return $this->localhostProfile;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setLocalhostProfile(string $localhostProfile): self
    {
        $this->localhostProfile = $localhostProfile;

        return $this;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'localhostProfile' => $this->localhostProfile,
            'type' => $this->type,
        ]);
    }
}
