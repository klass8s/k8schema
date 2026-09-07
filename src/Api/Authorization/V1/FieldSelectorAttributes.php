<?php

declare(strict_types=1);

namespace K8Schema\Api\Authorization\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\FieldSelectorRequirementList;

/**
 * FieldSelectorAttributes indicates a field limited access. Webhook authors are
 * encouraged to * ensure rawSelector and requirements are not both set * consider
 * the requirements field if set * not try to parse or consider the rawSelector
 * field if set. This is to avoid another CVE-2022-2880 (i.e. getting different
 * systems to agree on how exactly to parse a query is not something we want), see
 * https://www.oxeye.io/resources/golang-parameter-smuggling-attack for more
 * details. For the *SubjectAccessReview endpoints of the kube-apiserver: * If
 * rawSelector is empty and requirements are empty, the request is not limited. *
 * If rawSelector is present and requirements are empty, the rawSelector will be
 * parsed and limited if the parsing succeeds. * If rawSelector is empty and
 * requirements are present, the requirements should be honored * If rawSelector is
 * present and requirements are present, the request is invalid.
 */
class FieldSelectorAttributes implements JsonSerializable
{
    /**
     * rawSelector is the serialization of a field selector that would be included in a
     * query parameter. Webhook implementations are encouraged to ignore rawSelector.
     * The kube-apiserver's *SubjectAccessReview will parse the rawSelector as long as
     * the requirements are not present.
     */
    private string|null $rawSelector = null;

    /**
     * requirements is the parsed interpretation of a field selector. All requirements
     * must be met for a resource instance to match the selector. Webhook
     * implementations should handle requirements, but how to handle them is up to the
     * webhook. Since requirements can only limit the request, it is safe to authorize
     * as unlimited request if the requirements are not understood.
     */
    private FieldSelectorRequirementList $requirements;

    public function __construct()
    {
        $this->requirements = new FieldSelectorRequirementList();
    }

    public function getRawSelector(): string|null
    {
        return $this->rawSelector;
    }

    public function requirements(): FieldSelectorRequirementList
    {
        return $this->requirements;
    }

    public function setRawSelector(string $rawSelector): self
    {
        $this->rawSelector = $rawSelector;

        return $this;
    }

    public function setRequirements(FieldSelectorRequirementList $requirements): self
    {
        $this->requirements = $requirements;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'rawSelector' => $this->rawSelector,
            'requirements' => $this->requirements,
        ]);
    }
}
