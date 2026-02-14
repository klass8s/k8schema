<?php

declare(strict_types=1);

namespace K8Schema\ApiextensionsApiserver\Pkg\Apis\Apiextensions\V1;

use ArrayObject;
use JsonSerializable;

/**
 * CustomResourceValidation is a list of validation methods for CustomResources.
 */
class CustomResourceValidation implements JsonSerializable
{
    /**
     * openAPIV3Schema is the OpenAPI v3 schema to use for validation and pruning.
     */
    private JSONSchemaProps|null $openAPIV3Schema = null;

    public function __construct()
    {
    }

    public function getOpenAPIV3Schema(): JSONSchemaProps|null
    {
        return $this->openAPIV3Schema;
    }

    public function setOpenAPIV3Schema(JSONSchemaProps $openAPIV3Schema): self
    {
        $this->openAPIV3Schema = $openAPIV3Schema;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'openAPIV3Schema' => $this->openAPIV3Schema,
        ]);
    }
}
