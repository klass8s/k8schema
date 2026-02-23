<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * ComponentStatus (and ComponentStatusList) holds the cluster validation info.
 * Deprecated: This API is deprecated in v1.19+
 */
class ComponentStatus implements APIResourceInterface
{
    public const string API_VERSION = 'v1';
    public const string KIND = 'ComponentStatus';

    /**
     * List of component conditions observed
     */
    private ComponentConditionList $conditions;

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta|null $metadata = null;

    public function __construct()
    {
        $this->conditions = new ComponentConditionList();
    }

    public function conditions(): ComponentConditionList
    {
        return $this->conditions;
    }

    public function getMetadata(): ObjectMeta|null
    {
        return $this->metadata;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata ??= new ObjectMeta();
    }

    public function setConditions(ComponentConditionList $conditions): self
    {
        $this->conditions = $conditions;

        return $this;
    }

    public function setMetadata(ObjectMeta $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'conditions' => $this->conditions,
            'metadata' => $this->metadata,
        ]);
    }
}
