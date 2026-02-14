<?php

declare(strict_types=1);

namespace K8Schema\Api\Apps\V1;

use ArrayObject;
use JsonSerializable;

/**
 * StatefulSetUpdateStrategy indicates the strategy that the StatefulSet controller
 * will use to perform updates. It includes any additional parameters necessary to
 * perform the update for the indicated strategy.
 */
class StatefulSetUpdateStrategy implements JsonSerializable
{
    /**
     * RollingUpdate is used to communicate parameters when Type is
     * RollingUpdateStatefulSetStrategyType.
     */
    private RollingUpdateStatefulSetStrategy|null $rollingUpdate = null;

    /**
     * Type indicates the type of the StatefulSetUpdateStrategy. Default is
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

    public function rollingUpdate(): RollingUpdateStatefulSetStrategy
    {
        return $this->rollingUpdate ??= new RollingUpdateStatefulSetStrategy();
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
