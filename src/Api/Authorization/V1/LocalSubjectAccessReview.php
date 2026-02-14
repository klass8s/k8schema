<?php

declare(strict_types=1);

namespace K8Schema\Api\Authorization\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * LocalSubjectAccessReview checks whether or not a user or group can perform an
 * action in a given namespace. Having a namespace scoped resource makes it much
 * easier to grant namespace scoped policy that includes permissions checking.
 */
class LocalSubjectAccessReview implements APIResourceInterface
{
    public const string API_VERSION = 'authorization.k8s.io/v1';
    public const string KIND = 'LocalSubjectAccessReview';

    /**
     * Standard list metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Spec holds information about the request being evaluated.  spec.namespace must
     * be equal to the namespace you made the request against.  If empty, it is
     * defaulted.
     */
    private SubjectAccessReviewSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new SubjectAccessReviewSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): SubjectAccessReviewSpec
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
        ]);
    }
}
