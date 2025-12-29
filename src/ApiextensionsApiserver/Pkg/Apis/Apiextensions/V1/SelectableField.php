<?php

declare(strict_types=1);

namespace K8Schema\ApiextensionsApiserver\Pkg\Apis\Apiextensions\V1;

use JsonSerializable;

/**
 * SelectableField specifies the JSON path of a field that may be used with field
 * selectors.
 */
class SelectableField implements JsonSerializable
{
    /**
     * jsonPath is a simple JSON path which is evaluated against each custom resource
     * to produce a field selector value. Only JSON paths without the array notation
     * are allowed. Must point to a field of type string, boolean or integer. Types
     * with enum values and strings with formats are allowed. If jsonPath refers to
     * absent field in a resource, the jsonPath evaluates to an empty string. Must not
     * point to metdata fields. Required.
     */
    private string $jsonPath;

    public function __construct(string $jsonPath)
    {
        $this->jsonPath = $jsonPath;
    }

    public function getJsonPath(): string
    {
        return $this->jsonPath;
    }

    public function setJsonPath(string $jsonPath): self
    {
        $this->jsonPath = $jsonPath;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'jsonPath' => $this->jsonPath,
        ];
    }
}
