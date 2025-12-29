<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * Binding ties one object to another; for example, a pod is bound to a node by a
 * scheduler.
 */
class Binding implements APIResourceInterface
{
    public const string API_VERSION = 'v1';
    public const string KIND = 'Binding';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * The target object that you want to bind to the standard object.
     */
    private ObjectReference $target;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->target = new ObjectReference();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function target(): ObjectReference
    {
        return $this->target;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
            'target' => $this->target,
        ];
    }
}
