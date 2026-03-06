<?php

declare(strict_types=1);

namespace K8Schema\Api\Authentication\V1;

use ArrayObject;
use JsonSerializable;

/**
 * SelfSubjectReviewStatus is filled by the kube-apiserver and sent back to a user.
 */
class SelfSubjectReviewStatus implements JsonSerializable
{
    /**
     * User attributes of the user making this request.
     */
    private UserInfo|null $userInfo = null;

    public function __construct()
    {
    }

    public function getUserInfo(): UserInfo|null
    {
        return $this->userInfo;
    }

    public function setUserInfo(UserInfo $userInfo): self
    {
        $this->userInfo = $userInfo;

        return $this;
    }

    public function userInfo(): UserInfo
    {
        return $this->userInfo ??= new UserInfo();
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'userInfo' => $this->userInfo,
        ]);
    }
}
