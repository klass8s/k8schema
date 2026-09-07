<?php

declare(strict_types=1);

namespace K8Schema\Api\Authorization\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * SelfSubjectAccessReview checks whether or the current user can perform an
 * action.  Not filling in a spec.namespace means "in all namespaces".  Self is a
 * special case, because users should always be able to check whether they can
 * perform an action
 */
class SelfSubjectAccessReview implements APIResourceInterface
{
    public const string API_VERSION = 'authorization.k8s.io/v1';
    public const string KIND = 'SelfSubjectAccessReview';

    /**
     * metadata is the standard list metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * spec holds information about the request being evaluated.  user and groups must
     * be empty
     */
    private SelfSubjectAccessReviewSpec $spec;

    /**
     * status is filled in by the server and indicates whether the request is allowed
     * or not
     */
    private SubjectAccessReviewStatus|null $status = null;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new SelfSubjectAccessReviewSpec();
    }

    public function getStatus(): SubjectAccessReviewStatus|null
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

    public function setSpec(SelfSubjectAccessReviewSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function setStatus(SubjectAccessReviewStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function spec(): SelfSubjectAccessReviewSpec
    {
        return $this->spec;
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
