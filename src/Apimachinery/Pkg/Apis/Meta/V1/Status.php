<?php

declare(strict_types=1);

namespace K8Schema\Apimachinery\Pkg\Apis\Meta\V1;

use ArrayObject;
use K8Schema\APIResourceListInterface;

/**
 * Status is a return value for calls that don't return other objects.
 */
class Status implements APIResourceListInterface
{
    public const string API_VERSION = 'v1';
    public const string KIND = 'Status';

    /**
     * Suggested HTTP return code for this status, 0 if not set.
     */
    private int|null $code = null;

    /**
     * Extended data associated with the reason.  Each reason may define its own
     * extended details. This field is optional and the data returned is not guaranteed
     * to conform to any schema except that defined by the reason type.
     */
    private StatusDetails|null $details = null;

    /**
     * A human-readable description of the status of this operation.
     */
    private string|null $message = null;

    /**
     * Standard list metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#types-kinds
     */
    private ListMeta|null $metadata = null;

    /**
     * A machine-readable description of why this operation is in the "Failure" status.
     * If this value is empty there is no information available. A Reason clarifies an
     * HTTP status code but does not override it.
     */
    private string|null $reason = null;

    public function __construct()
    {
    }

    public function details(): StatusDetails
    {
        return $this->details ??= new StatusDetails();
    }

    public function getCode(): int|null
    {
        return $this->code;
    }

    public function getMessage(): string|null
    {
        return $this->message;
    }

    public function getReason(): string|null
    {
        return $this->reason;
    }

    public function metadata(): ListMeta
    {
        return $this->metadata ??= new ListMeta();
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

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

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'code' => $this->code,
            'details' => $this->details,
            'message' => $this->message,
            'metadata' => $this->metadata,
            'reason' => $this->reason,
        ]);
    }
}
