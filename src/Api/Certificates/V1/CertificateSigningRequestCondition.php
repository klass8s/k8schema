<?php

declare(strict_types=1);

namespace K8Schema\Api\Certificates\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\DateTimeInterface;

/**
 * CertificateSigningRequestCondition describes a condition of a
 * CertificateSigningRequest object
 */
class CertificateSigningRequestCondition implements JsonSerializable
{
    /**
     * lastTransitionTime is the time the condition last transitioned from one status
     * to another. If unset, when a new condition type is added or an existing
     * condition's status is changed, the server defaults this to the current time.
     */
    private DateTimeInterface|null $lastTransitionTime = null;

    /**
     * lastUpdateTime is the time of the last update to this condition
     */
    private DateTimeInterface|null $lastUpdateTime = null;

    /**
     * message contains a human readable message with details about the request state
     */
    private string|null $message = null;

    /**
     * reason indicates a brief reason for the request state
     */
    private string|null $reason = null;

    /**
     * status of the condition, one of True, False, Unknown. Approved, Denied, and
     * Failed conditions may not be "False" or "Unknown".
     */
    private string $status;

    /**
     * type of the condition. Known conditions are "Approved", "Denied", and "Failed".
     *
     * An "Approved" condition is added via the /approval subresource, indicating the
     * request was approved and should be issued by the signer.
     *
     * A "Denied" condition is added via the /approval subresource, indicating the
     * request was denied and should not be issued by the signer.
     *
     * A "Failed" condition is added via the /status subresource, indicating the signer
     * failed to issue the certificate.
     *
     * Approved and Denied conditions are mutually exclusive. Approved, Denied, and
     * Failed conditions cannot be removed once added.
     *
     * Only one condition of a given type is allowed.
     */
    private string $type;

    public function __construct(string $status, string $type)
    {
        $this->status = $status;
        $this->type = $type;
    }

    public function getLastTransitionTime(): DateTimeInterface|null
    {
        return $this->lastTransitionTime;
    }

    public function getLastUpdateTime(): DateTimeInterface|null
    {
        return $this->lastUpdateTime;
    }

    public function getMessage(): string|null
    {
        return $this->message;
    }

    public function getReason(): string|null
    {
        return $this->reason;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setLastTransitionTime(DateTimeInterface $lastTransitionTime): self
    {
        $this->lastTransitionTime = $lastTransitionTime;

        return $this;
    }

    public function setLastUpdateTime(DateTimeInterface $lastUpdateTime): self
    {
        $this->lastUpdateTime = $lastUpdateTime;

        return $this;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function setReason(string $reason): self
    {
        $this->reason = $reason;

        return $this;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

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
            'lastTransitionTime' => $this->lastTransitionTime,
            'lastUpdateTime' => $this->lastUpdateTime,
            'message' => $this->message,
            'reason' => $this->reason,
            'status' => $this->status,
            'type' => $this->type,
        ]);
    }
}
