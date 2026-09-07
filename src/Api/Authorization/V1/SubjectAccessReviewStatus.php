<?php

declare(strict_types=1);

namespace K8Schema\Api\Authorization\V1;

use ArrayObject;
use JsonSerializable;

/**
 * SubjectAccessReviewStatus
 */
class SubjectAccessReviewStatus implements JsonSerializable
{
    /**
     * allowed is required. True if the action would be allowed, false otherwise.
     */
    private bool $allowed;

    /**
     * denied is optional. True if the action would be denied, otherwise false. If both
     * allowed is false and denied is false, then the authorizer has no opinion on
     * whether to authorize the action. Denied may not be true if Allowed is true.
     */
    private bool|null $denied = null;

    /**
     * evaluationError is an indication that some error occurred during the
     * authorization check. It is entirely possible to get an error and be able to
     * continue determine authorization status in spite of it. For instance, RBAC can
     * be missing a role, but enough roles are still present and bound to reason about
     * the request.
     */
    private string|null $evaluationError = null;

    /**
     * reason is optional.  It indicates why a request was allowed or denied.
     */
    private string|null $reason = null;

    public function __construct(bool $allowed)
    {
        $this->allowed = $allowed;
    }

    public function getAllowed(): bool
    {
        return $this->allowed;
    }

    public function getDenied(): bool|null
    {
        return $this->denied;
    }

    public function getEvaluationError(): string|null
    {
        return $this->evaluationError;
    }

    public function getReason(): string|null
    {
        return $this->reason;
    }

    public function setAllowed(bool $allowed): self
    {
        $this->allowed = $allowed;

        return $this;
    }

    public function setDenied(bool $denied): self
    {
        $this->denied = $denied;

        return $this;
    }

    public function setEvaluationError(string $evaluationError): self
    {
        $this->evaluationError = $evaluationError;

        return $this;
    }

    public function setReason(string $reason): self
    {
        $this->reason = $reason;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'allowed' => $this->allowed,
            'denied' => $this->denied,
            'evaluationError' => $this->evaluationError,
            'reason' => $this->reason,
        ]);
    }
}
