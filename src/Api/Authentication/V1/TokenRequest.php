<?php

declare(strict_types=1);

namespace K8Schema\Api\Authentication\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * TokenRequest requests a token for a given service account.
 */
class TokenRequest implements APIResourceInterface
{
    public const string API_VERSION = 'authentication.k8s.io/v1';
    public const string KIND = 'TokenRequest';

    /**
     * metadata is the standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * spec holds information about the request being evaluated
     */
    private TokenRequestSpec $spec;

    /**
     * status is filled in by the server and indicates whether the token can be
     * authenticated.
     */
    private TokenRequestStatus|null $status = null;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new TokenRequestSpec();
    }

    public function getStatus(): TokenRequestStatus|null
    {
        return $this->status;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setMetadata(ObjectMeta $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    public function setSpec(TokenRequestSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function setStatus(TokenRequestStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function spec(): TokenRequestSpec
    {
        return $this->spec;
    }

    public function status(): TokenRequestStatus
    {
        return $this->status ??= new TokenRequestStatus();
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
            'spec' => $this->spec,
            'status' => $this->status,
        ]);
    }
}
