<?php

declare(strict_types=1);

namespace K8Schema\KubeAggregator\Pkg\Apis\Apiregistration\V1;

use ArrayObject;
use JsonSerializable;

/**
 * APIServiceStatus contains derived information about an API server
 */
class APIServiceStatus implements JsonSerializable
{
    /**
     * Current service state of apiService.
     */
    private APIServiceConditionList $conditions;

    public function __construct()
    {
        $this->conditions = new APIServiceConditionList();
    }

    public function conditions(): APIServiceConditionList
    {
        return $this->conditions;
    }

    public function setConditions(APIServiceConditionList $conditions): self
    {
        $this->conditions = $conditions;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'conditions' => $this->conditions,
        ]);
    }
}
