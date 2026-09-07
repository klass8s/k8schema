<?php

declare(strict_types=1);

namespace K8Schema\Api\Lifecycle\V1alpha1;

use ArrayObject;
use JsonSerializable;

/**
 * Requester allows you to identify the entity, that requested the eviction of the
 * target.
 */
class Requester implements JsonSerializable
{
    /**
     * intent specifies the action that should be taken for the specified target.
     *
     * - Eviction means that the requester is interested in the eviction of the target.
     * - Withdrawn means that the requester is no longer interested in the eviction of
     * the target.
     *   If all requesters' intents are withdrawn, the eviction will be canceled.
     *   Cancellation consequences:
     *   - Inactive responders will never run.
     *   - Active responders are expected to cancel the eviction.
     *   - Completed or Interrupted responders should not take any action.
     */
    private string $intent;

    /**
     * name allows you to identify the entity, that requested the eviction of the
     * target.
     *
     * It must be a valid domain-prefixed key (such as "acme.io/foo"). This field must
     * be unique for each requester. This field is required.
     */
    private string $name;

    public function __construct(string $intent, string $name)
    {
        $this->intent = $intent;
        $this->name = $name;
    }

    public function getIntent(): string
    {
        return $this->intent;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setIntent(string $intent): self
    {
        $this->intent = $intent;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'intent' => $this->intent,
            'name' => $this->name,
        ]);
    }
}
