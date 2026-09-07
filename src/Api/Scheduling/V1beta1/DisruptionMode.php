<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1beta1;

use ArrayObject;
use JsonSerializable;

/**
 * DisruptionMode defines how individual entities within a group can be disrupted.
 * Exactly one mode can be set.
 */
class DisruptionMode implements JsonSerializable
{
    /**
     * all specifies that all children can only be disrupted together.
     */
    private AllDisruptionMode|null $all = null;

    /**
     * single specifies that children can be disrupted independently from each other.
     */
    private SingleDisruptionMode|null $single = null;

    public function __construct()
    {
    }

    public function all(): AllDisruptionMode
    {
        return $this->all ??= new AllDisruptionMode();
    }

    public function getAll(): AllDisruptionMode|null
    {
        return $this->all;
    }

    public function getSingle(): SingleDisruptionMode|null
    {
        return $this->single;
    }

    public function setAll(AllDisruptionMode $all): self
    {
        $this->all = $all;

        return $this;
    }

    public function setSingle(SingleDisruptionMode $single): self
    {
        $this->single = $single;

        return $this;
    }

    public function single(): SingleDisruptionMode
    {
        return $this->single ??= new SingleDisruptionMode();
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'all' => $this->all,
            'single' => $this->single,
        ]);
    }
}
