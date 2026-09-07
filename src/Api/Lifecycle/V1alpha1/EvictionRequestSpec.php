<?php

declare(strict_types=1);

namespace K8Schema\Api\Lifecycle\V1alpha1;

use ArrayObject;
use JsonSerializable;

/**
 * EvictionRequestSpec is a specification of an EvictionRequest.
 */
class EvictionRequestSpec implements JsonSerializable
{
    /**
     * intent specifies the action that should be taken for the specified target.
     *
     * - Eviction means that the requester is interested in the eviction of the target.
     * - Withdrawn means that the requester is no longer interested in the eviction of
     * the target.
     *   If all requesters' intents are withdrawn for a common target, the eviction
     * will be canceled.
     *   Cancellation consequences:
     *   - Inactive responders will never run.
     *   - Active responders are expected to cancel the eviction.
     *   - Completed or Interrupted responders should not take any action.
     */
    private string $intent;

    /**
     * requester allows you to identify the entity, that requested the eviction of the
     * target.
     *
     * It must be a valid domain-prefixed key (such as "acme.io/foo"). Domain names
     * *.k8s.io and *.kubernetes.io are reserved. This field is required and immutable.
     */
    private string $requester;

    /**
     * target contains a reference to an object (e.g. a pod) that should be evicted.
     * This field is required and immutable.
     */
    private EvictionRequestTarget $target;

    public function __construct(string $intent, string $requester)
    {
        $this->intent = $intent;
        $this->requester = $requester;
        $this->target = new EvictionRequestTarget();
    }

    public function getIntent(): string
    {
        return $this->intent;
    }

    public function getRequester(): string
    {
        return $this->requester;
    }

    public function setIntent(string $intent): self
    {
        $this->intent = $intent;

        return $this;
    }

    public function setRequester(string $requester): self
    {
        $this->requester = $requester;

        return $this;
    }

    public function setTarget(EvictionRequestTarget $target): self
    {
        $this->target = $target;

        return $this;
    }

    public function target(): EvictionRequestTarget
    {
        return $this->target;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'intent' => $this->intent,
            'requester' => $this->requester,
            'target' => $this->target,
        ]);
    }
}
