<?php

declare(strict_types=1);

namespace K8Schema\Api\Networking\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * IngressClass represents the class of the Ingress, referenced by the Ingress
 * Spec. The `ingressclass.kubernetes.io/is-default-class` annotation can be used
 * to indicate that an IngressClass should be considered default. When a single
 * IngressClass resource has this annotation set to true, new Ingress resources
 * without a class specified will be assigned this default class.
 */
class IngressClass implements APIResourceInterface
{
    public const string API_VERSION = 'networking.k8s.io/v1';
    public const string KIND = 'IngressClass';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * spec is the desired state of the IngressClass. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private IngressClassSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new IngressClassSpec();
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

    public function setSpec(IngressClassSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function spec(): IngressClassSpec
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
