<?php

declare(strict_types=1);

namespace K8Schema\Api\Admissionregistration\V1alpha1;

use JsonSerializable;

/**
 * Mutation specifies the CEL expression which is used to apply the Mutation.
 */
class Mutation implements JsonSerializable
{
    /**
     * applyConfiguration defines the desired configuration values of an object. The
     * configuration is applied to the admission object using [structured merge
     * diff](https://github.com/kubernetes-sigs/structured-merge-diff). A CEL
     * expression is used to create apply configuration.
     */
    private ApplyConfiguration $applyConfiguration;

    /**
     * jsonPatch defines a [JSON patch](https://jsonpatch.com/) operation to perform a
     * mutation to the object. A CEL expression is used to create the JSON patch.
     */
    private JSONPatch $jsonPatch;

    /**
     * patchType indicates the patch strategy used. Allowed values are
     * "ApplyConfiguration" and "JSONPatch". Required.
     */
    private string $patchType;

    public function __construct(string $patchType)
    {
        $this->applyConfiguration = new ApplyConfiguration();
        $this->jsonPatch = new JSONPatch();
        $this->patchType = $patchType;
    }

    public function applyConfiguration(): ApplyConfiguration
    {
        return $this->applyConfiguration;
    }

    public function getPatchType(): string
    {
        return $this->patchType;
    }

    public function jsonPatch(): JSONPatch
    {
        return $this->jsonPatch;
    }

    public function setPatchType(string $patchType): self
    {
        $this->patchType = $patchType;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'applyConfiguration' => $this->applyConfiguration,
            'jsonPatch' => $this->jsonPatch,
            'patchType' => $this->patchType,
        ];
    }
}
