<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1beta1;

use ArrayObject;
use JsonSerializable;

/**
 * CompositeDisruptionMode defines how individual entities within a composite pod
 * group can be disrupted. Exactly one mode must be set.
 */
class CompositeDisruptionMode implements JsonSerializable
{
    /**
     * all specifies that all children groups can only be disrupted together.
     */
    private AllCompositeDisruptionMode|null $all = null;

    /**
     * single specifies that children groups can be disrupted independently from each
     * other.
     */
    private SingleCompositeDisruptionMode|null $single = null;

    public function __construct()
    {
    }

    public function all(): AllCompositeDisruptionMode
    {
        return $this->all ??= new AllCompositeDisruptionMode();
    }

    public function getAll(): AllCompositeDisruptionMode|null
    {
        return $this->all;
    }

    public function getSingle(): SingleCompositeDisruptionMode|null
    {
        return $this->single;
    }

    public function setAll(AllCompositeDisruptionMode $all): self
    {
        $this->all = $all;

        return $this;
    }

    public function setSingle(SingleCompositeDisruptionMode $single): self
    {
        $this->single = $single;

        return $this;
    }

    public function single(): SingleCompositeDisruptionMode
    {
        return $this->single ??= new SingleCompositeDisruptionMode();
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'all' => $this->all,
            'single' => $this->single,
        ]);
    }
}
