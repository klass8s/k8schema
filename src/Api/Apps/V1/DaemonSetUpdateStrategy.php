<?php

declare(strict_types=1);

namespace K8Schema\Api\Apps\V1;

use ArrayObject;
use JsonSerializable;

/**
 * DaemonSetUpdateStrategy is a struct used to control the update strategy for a
 * DaemonSet.
 */
class DaemonSetUpdateStrategy implements JsonSerializable
{
    /**
     * Rolling update config params. Present only if type = "RollingUpdate".
     */
    private RollingUpdateDaemonSet|null $rollingUpdate = null;

    /**
     * Type of daemon set update. Can be "RollingUpdate" or "OnDelete". Default is
     * RollingUpdate.
     */
    private string|null $type = null;

    public function __construct()
    {
    }

    public function getRollingUpdate(): RollingUpdateDaemonSet|null
    {
        return $this->rollingUpdate;
    }

    public function getType(): string|null
    {
        return $this->type;
    }

    public function rollingUpdate(): RollingUpdateDaemonSet
    {
        return $this->rollingUpdate ??= new RollingUpdateDaemonSet();
    }

    public function setRollingUpdate(RollingUpdateDaemonSet $rollingUpdate): self
    {
        $this->rollingUpdate = $rollingUpdate;

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
            'rollingUpdate' => $this->rollingUpdate,
            'type' => $this->type,
        ]);
    }
}
