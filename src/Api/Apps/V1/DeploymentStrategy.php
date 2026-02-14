<?php

declare(strict_types=1);

namespace K8Schema\Api\Apps\V1;

use ArrayObject;
use JsonSerializable;

/**
 * DeploymentStrategy describes how to replace existing pods with new ones.
 */
class DeploymentStrategy implements JsonSerializable
{
    /**
     * Rolling update config params. Present only if DeploymentStrategyType =
     * RollingUpdate.
     */
    private RollingUpdateDeployment|null $rollingUpdate = null;

    /**
     * Type of deployment. Can be "Recreate" or "RollingUpdate". Default is
     * RollingUpdate.
     */
    private string|null $type = null;

    public function __construct()
    {
    }

    public function getType(): string|null
    {
        return $this->type;
    }

    public function rollingUpdate(): RollingUpdateDeployment
    {
        return $this->rollingUpdate ??= new RollingUpdateDeployment();
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'rollingUpdate' => $this->rollingUpdate,
            'type' => $this->type,
        ]);
    }
}
