<?php

declare(strict_types=1);

namespace K8Schema\Api\Authorization\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringList;
use K8Schema\Collection\StringListMap;

/**
 * SubjectAccessReviewSpec is a description of the access request.  Exactly one of
 * resourceAttributes and nonResourceAttributes must be set
 */
class SubjectAccessReviewSpec implements JsonSerializable
{
    /**
     * extra corresponds to the user.Info.GetExtra() method from the authenticator.
     * Since that is input to the authorizer it needs a reflection here.
     */
    private StringListMap $extra;

    /**
     * groups is the groups you're testing for.
     */
    private StringList $groups;

    /**
     * nonResourceAttributes describes information for a non-resource access request
     */
    private NonResourceAttributes|null $nonResourceAttributes = null;

    /**
     * resourceAttributes describes information for a resource access request
     */
    private ResourceAttributes|null $resourceAttributes = null;

    /**
     * uid information about the requesting user.
     */
    private string|null $uid = null;

    /**
     * user is the user you're testing for. If you specify "User" but not "Groups",
     * then is it interpreted as "What if User were not a member of any groups
     */
    private string|null $user = null;

    public function __construct()
    {
        $this->extra = new StringListMap();
        $this->groups = new StringList();
    }

    public function extra(): StringListMap
    {
        return $this->extra;
    }

    public function getNonResourceAttributes(): NonResourceAttributes|null
    {
        return $this->nonResourceAttributes;
    }

    public function getResourceAttributes(): ResourceAttributes|null
    {
        return $this->resourceAttributes;
    }

    public function getUid(): string|null
    {
        return $this->uid;
    }

    public function getUser(): string|null
    {
        return $this->user;
    }

    public function groups(): StringList
    {
        return $this->groups;
    }

    public function nonResourceAttributes(): NonResourceAttributes
    {
        return $this->nonResourceAttributes ??= new NonResourceAttributes();
    }

    public function resourceAttributes(): ResourceAttributes
    {
        return $this->resourceAttributes ??= new ResourceAttributes();
    }

    public function setExtra(StringListMap $extra): self
    {
        $this->extra = $extra;

        return $this;
    }

    public function setGroups(StringList $groups): self
    {
        $this->groups = $groups;

        return $this;
    }

    public function setNonResourceAttributes(NonResourceAttributes $nonResourceAttributes): self
    {
        $this->nonResourceAttributes = $nonResourceAttributes;

        return $this;
    }

    public function setResourceAttributes(ResourceAttributes $resourceAttributes): self
    {
        $this->resourceAttributes = $resourceAttributes;

        return $this;
    }

    public function setUid(string $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    public function setUser(string $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'extra' => $this->extra,
            'groups' => $this->groups,
            'nonResourceAttributes' => $this->nonResourceAttributes,
            'resourceAttributes' => $this->resourceAttributes,
            'uid' => $this->uid,
            'user' => $this->user,
        ]);
    }
}
