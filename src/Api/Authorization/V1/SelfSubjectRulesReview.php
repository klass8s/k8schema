<?php

declare(strict_types=1);

namespace K8Schema\Api\Authorization\V1;

use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * SelfSubjectRulesReview enumerates the set of actions the current user can
 * perform within a namespace. The returned list of actions may be incomplete
 * depending on the server's authorization mode, and any errors experienced during
 * the evaluation. SelfSubjectRulesReview should be used by UIs to show/hide
 * actions, or to quickly let an end user reason about their permissions. It should
 * NOT Be used by external systems to drive authorization decisions as this raises
 * confused deputy, cache lifetime/revocation, and correctness concerns.
 * SubjectAccessReview, and LocalAccessReview are the correct way to defer
 * authorization decisions to the API server.
 */
class SelfSubjectRulesReview implements APIResourceInterface
{
    public const string API_VERSION = 'authorization.k8s.io/v1';
    public const string KIND = 'SelfSubjectRulesReview';

    /**
     * Standard list metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Spec holds information about the request being evaluated.
     */
    private SelfSubjectRulesReviewSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new SelfSubjectRulesReviewSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): SelfSubjectRulesReviewSpec
    {
        return $this->spec;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
            'spec' => $this->spec,
        ];
    }
}
