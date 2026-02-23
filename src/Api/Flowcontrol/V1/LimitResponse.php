<?php

declare(strict_types=1);

namespace K8Schema\Api\Flowcontrol\V1;

use ArrayObject;
use JsonSerializable;

/**
 * LimitResponse defines how to handle requests that can not be executed right now.
 */
class LimitResponse implements JsonSerializable
{
    /**
     * `queuing` holds the configuration parameters for queuing. This field may be
     * non-empty only if `type` is `"Queue"`.
     */
    private QueuingConfiguration|null $queuing = null;

    /**
     * `type` is "Queue" or "Reject". "Queue" means that requests that can not be
     * executed upon arrival are held in a queue until they can be executed or a
     * queuing limit is reached. "Reject" means that requests that can not be executed
     * upon arrival are rejected. Required.
     */
    private string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function getQueuing(): QueuingConfiguration|null
    {
        return $this->queuing;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function queuing(): QueuingConfiguration
    {
        return $this->queuing ??= new QueuingConfiguration();
    }

    public function setQueuing(QueuingConfiguration $queuing): self
    {
        $this->queuing = $queuing;

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
            'queuing' => $this->queuing,
            'type' => $this->type,
        ]);
    }
}
