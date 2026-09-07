<?php

declare(strict_types=1);

namespace K8Schema\ApiextensionsApiserver\Pkg\Apis\Apiextensions\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * CustomResourceDefinition represents a resource that should be exposed on the API
 * server.  Its name MUST be in the format <.spec.name>.<.spec.group>.
 */
class CustomResourceDefinition implements APIResourceInterface
{
    public const string API_VERSION = 'apiextensions.k8s.io/v1';
    public const string KIND = 'CustomResourceDefinition';

    /**
     * Standard object's metadata More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * spec describes how the user wants the resources to appear
     */
    private CustomResourceDefinitionSpec $spec;

    /**
     * status indicates the actual state of the CustomResourceDefinition
     */
    private CustomResourceDefinitionStatus|null $status = null;

    public function __construct(CustomResourceDefinitionSpec $spec)
    {
        $this->metadata = new ObjectMeta();
        $this->spec = $spec;
    }

    public function getSpec(): CustomResourceDefinitionSpec
    {
        return $this->spec;
    }

    public function getStatus(): CustomResourceDefinitionStatus|null
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

    public function setSpec(CustomResourceDefinitionSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function setStatus(CustomResourceDefinitionStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function status(): CustomResourceDefinitionStatus
    {
        return $this->status ??= new CustomResourceDefinitionStatus();
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
