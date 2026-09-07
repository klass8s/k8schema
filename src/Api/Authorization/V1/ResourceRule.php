<?php

declare(strict_types=1);

namespace K8Schema\Api\Authorization\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringList;

/**
 * ResourceRule is the list of actions the subject is allowed to perform on
 * resources. The list ordering isn't significant, may contain duplicates, and
 * possibly be incomplete.
 */
class ResourceRule implements JsonSerializable
{
    /**
     * apiGroups is the name of the APIGroup that contains the resources.  If multiple
     * API groups are specified, any action requested against one of the enumerated
     * resources in any API group will be allowed.  "*" means all.
     */
    private StringList $apiGroups;

    /**
     * resourceNames is an optional white list of names that the rule applies to.  An
     * empty set means that everything is allowed.  "*" means all.
     */
    private StringList $resourceNames;

    /**
     * resources is a list of resources this rule applies to.  "*" means all in the
     * specified apiGroups.
     *  "*\/foo" represents the subresource 'foo' for all resources in the specified
     * apiGroups.
     */
    private StringList $resources;

    /**
     * verbs is a list of kubernetes resource API verbs, like: get, list, watch,
     * create, update, delete, proxy.  "*" means all.
     */
    private StringList $verbs;

    public function __construct()
    {
        $this->apiGroups = new StringList();
        $this->resourceNames = new StringList();
        $this->resources = new StringList();
        $this->verbs = new StringList();
    }

    public function apiGroups(): StringList
    {
        return $this->apiGroups;
    }

    public function resourceNames(): StringList
    {
        return $this->resourceNames;
    }

    public function resources(): StringList
    {
        return $this->resources;
    }

    public function setApiGroups(StringList $apiGroups): self
    {
        $this->apiGroups = $apiGroups;

        return $this;
    }

    public function setResourceNames(StringList $resourceNames): self
    {
        $this->resourceNames = $resourceNames;

        return $this;
    }

    public function setResources(StringList $resources): self
    {
        $this->resources = $resources;

        return $this;
    }

    public function setVerbs(StringList $verbs): self
    {
        $this->verbs = $verbs;

        return $this;
    }

    public function verbs(): StringList
    {
        return $this->verbs;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'apiGroups' => $this->apiGroups,
            'resourceNames' => $this->resourceNames,
            'resources' => $this->resources,
            'verbs' => $this->verbs,
        ]);
    }
}
