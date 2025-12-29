<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

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
    private ObjectMeta $metadata;

    public function __construct()
    {
        $this->conditions = new ComponentConditionList();
        $this->metadata = new ObjectMeta();
    }

    public function conditions(): ComponentConditionList
    {
        return $this->conditions;
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
            'conditions' => $this->conditions,
            'metadata' => $this->metadata,
        ];
    }
}
