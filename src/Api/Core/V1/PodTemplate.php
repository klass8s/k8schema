<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * PodTemplate describes a template for creating copies of a predefined pod.
 */
class PodTemplate implements APIResourceInterface
{
    public const string API_VERSION = 'v1';
    public const string KIND = 'PodTemplate';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta|null $metadata = null;

    /**
     * Template defines the pods that will be created from this pod template.
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private PodTemplateSpec|null $template = null;

    public function __construct()
    {
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata ??= new ObjectMeta();
    }

    public function template(): PodTemplateSpec
    {
        return $this->template ??= new PodTemplateSpec();
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
            'template' => $this->template,
        ]);
    }
}
