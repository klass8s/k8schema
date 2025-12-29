<?php

declare(strict_types=1);

namespace K8Schema\Api\Authentication\V1;

use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * SelfSubjectReview contains the user information that the kube-apiserver has
 * about the user making this request. When using impersonation, users will receive
 * the user info of the user being impersonated.  If impersonation or request
 * header authentication is used, any extra keys will have their case ignored and
 * returned as lowercase.
 */
class SelfSubjectReview implements APIResourceInterface
{
    public const string API_VERSION = 'authentication.k8s.io/v1';
    public const string KIND = 'SelfSubjectReview';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
        ];
    }
}
