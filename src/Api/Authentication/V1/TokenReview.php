<?php

declare(strict_types=1);

namespace K8Schema\Api\Authentication\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * TokenReview attempts to authenticate a token to a known user. Note: TokenReview
 * requests may be cached by the webhook token authenticator plugin in the
 * kube-apiserver.
 */
class TokenReview implements APIResourceInterface
{
    public const string API_VERSION = 'authentication.k8s.io/v1';
    public const string KIND = 'TokenReview';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Spec holds information about the request being evaluated
     */
    private TokenReviewSpec $spec;

    /**
     * Status is filled in by the server and indicates whether the request can be
     * authenticated.
     */
    private TokenReviewStatus|null $status = null;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new TokenReviewSpec();
    }

    public function getStatus(): TokenReviewStatus|null
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

    public function setSpec(TokenReviewSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function setStatus(TokenReviewStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function spec(): TokenReviewSpec
    {
        return $this->spec;
    }

    public function status(): TokenReviewStatus
    {
        return $this->status ??= new TokenReviewStatus();
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
