<?php

declare(strict_types=1);

namespace K8Schema\Api\Flowcontrol\V1;

use ArrayObject;
use JsonSerializable;

/**
 * PriorityLevelConfigurationSpec specifies the configuration of a priority level.
 */
class PriorityLevelConfigurationSpec implements JsonSerializable
{
    /**
     * `exempt` specifies how requests are handled for an exempt priority level. This
     * field MUST be empty if `type` is `"Limited"`. This field MAY be non-empty if
     * `type` is `"Exempt"`. If empty and `type` is `"Exempt"` then the default values
     * for `ExemptPriorityLevelConfiguration` apply.
     */
    private ExemptPriorityLevelConfiguration|null $exempt = null;

    /**
     * `limited` specifies how requests are handled for a Limited priority level. This
     * field must be non-empty if and only if `type` is `"Limited"`.
     */
    private LimitedPriorityLevelConfiguration|null $limited = null;

    /**
     * `type` indicates whether this priority level is subject to limitation on request
     * execution.  A value of `"Exempt"` means that requests of this priority level are
     * not subject to a limit (and thus are never queued) and do not detract from the
     * capacity made available to other priority levels.  A value of `"Limited"` means
     * that (a) requests of this priority level _are_ subject to limits and (b) some of
     * the server's limited capacity is made available exclusively to this priority
     * level. Required.
     */
    private string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function exempt(): ExemptPriorityLevelConfiguration
    {
        return $this->exempt ??= new ExemptPriorityLevelConfiguration();
    }

    public function getExempt(): ExemptPriorityLevelConfiguration|null
    {
        return $this->exempt;
    }

    public function getLimited(): LimitedPriorityLevelConfiguration|null
    {
        return $this->limited;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function limited(): LimitedPriorityLevelConfiguration
    {
        return $this->limited ??= new LimitedPriorityLevelConfiguration();
    }

    public function setExempt(ExemptPriorityLevelConfiguration $exempt): self
    {
        $this->exempt = $exempt;

        return $this;
    }

    public function setLimited(LimitedPriorityLevelConfiguration $limited): self
    {
        $this->limited = $limited;

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
            'exempt' => $this->exempt,
            'limited' => $this->limited,
            'type' => $this->type,
        ]);
    }
}
