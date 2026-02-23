<?php

declare(strict_types=1);

namespace K8Schema\Api\Rbac\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * ClusterRoleBinding references a ClusterRole, but not contain it.  It can
 * reference a ClusterRole in the global namespace, and adds who information via
 * Subject.
 */
class ClusterRoleBinding implements APIResourceInterface
{
    public const string API_VERSION = 'rbac.authorization.k8s.io/v1';
    public const string KIND = 'ClusterRoleBinding';

    /**
     * Standard object's metadata.
     */
    private ObjectMeta|null $metadata = null;

    /**
     * RoleRef can only reference a ClusterRole in the global namespace. If the RoleRef
     * cannot be resolved, the Authorizer must return an error. This field is
     * immutable.
     */
    private RoleRef $roleRef;

    /**
     * Subjects holds references to the objects the role applies to.
     */
    private SubjectList $subjects;

    public function __construct(RoleRef $roleRef)
    {
        $this->roleRef = $roleRef;
        $this->subjects = new SubjectList();
    }

    public function getMetadata(): ObjectMeta|null
    {
        return $this->metadata;
    }

    public function getRoleRef(): RoleRef
    {
        return $this->roleRef;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata ??= new ObjectMeta();
    }

    public function setMetadata(ObjectMeta $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    public function setRoleRef(RoleRef $roleRef): self
    {
        $this->roleRef = $roleRef;

        return $this;
    }

    public function setSubjects(SubjectList $subjects): self
    {
        $this->subjects = $subjects;

        return $this;
    }

    public function subjects(): SubjectList
    {
        return $this->subjects;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
            'roleRef' => $this->roleRef,
            'subjects' => $this->subjects,
        ]);
    }
}
