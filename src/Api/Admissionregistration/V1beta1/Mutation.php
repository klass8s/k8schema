<?php

declare(strict_types=1);

namespace K8Schema\Api\Admissionregistration\V1beta1;

use ArrayObject;
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
    private ApplyConfiguration|null $applyConfiguration = null;

    /**
     * jsonPatch defines a [JSON patch](https://jsonpatch.com/) operation to perform a
     * mutation to the object. A CEL expression is used to create the JSON patch.
     */
    private JSONPatch|null $jsonPatch = null;

    /**
     * patchType indicates the patch strategy used. Allowed values are
     * "ApplyConfiguration" and "JSONPatch". Required.
     */
    private string $patchType;

    public function __construct(string $patchType)
    {
        $this->patchType = $patchType;
    }

    public function applyConfiguration(): ApplyConfiguration
    {
        return $this->applyConfiguration ??= new ApplyConfiguration();
    }

    public function getApplyConfiguration(): ApplyConfiguration|null
    {
        return $this->applyConfiguration;
    }

    public function getJsonPatch(): JSONPatch|null
    {
        return $this->jsonPatch;
    }

    public function getPatchType(): string
    {
        return $this->patchType;
    }

    public function jsonPatch(): JSONPatch
    {
        return $this->jsonPatch ??= new JSONPatch();
    }

    public function setApplyConfiguration(ApplyConfiguration $applyConfiguration): self
    {
        $this->applyConfiguration = $applyConfiguration;

        return $this;
    }

    public function setJsonPatch(JSONPatch $jsonPatch): self
    {
        $this->jsonPatch = $jsonPatch;

        return $this;
    }

    public function setPatchType(string $patchType): self
    {
        $this->patchType = $patchType;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'applyConfiguration' => $this->applyConfiguration,
            'jsonPatch' => $this->jsonPatch,
            'patchType' => $this->patchType,
        ]);
    }
}
