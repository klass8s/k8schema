<?php

declare(strict_types=1);

namespace K8Schema\Api\Authentication\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringList;
use K8Schema\Collection\StringListMap;

/**
 * UserInfo holds the information about the user needed to implement the user.Info
 * interface.
 */
class UserInfo implements JsonSerializable
{
    /**
     * extra is any additional information provided by the authenticator.
     */
    private StringListMap $extra;

    /**
     * groups is the names of groups this user is a part of.
     */
    private StringList $groups;

    /**
     * uid is a unique value that identifies this user across time. If this user is
     * deleted and another user by the same name is added, they will have different
     * UIDs.
     */
    private string|null $uid = null;

    /**
     * username is the name that uniquely identifies this user among all active users.
     */
    private string|null $username = null;

    public function __construct()
    {
        $this->extra = new StringListMap();
        $this->groups = new StringList();
    }

    public function extra(): StringListMap
    {
        return $this->extra;
    }

    public function getUid(): string|null
    {
        return $this->uid;
    }

    public function getUsername(): string|null
    {
        return $this->username;
    }

    public function groups(): StringList
    {
        return $this->groups;
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

    public function setUid(string $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'extra' => $this->extra,
            'groups' => $this->groups,
            'uid' => $this->uid,
            'username' => $this->username,
        ]);
    }
}
