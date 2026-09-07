<?php

declare(strict_types=1);

namespace K8Schema\Api\Authentication\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringList;

/**
 * TokenReviewStatus is the result of the token authentication request.
 */
class TokenReviewStatus implements JsonSerializable
{
    /**
     * audiences are audience identifiers chosen by the authenticator that are
     * compatible with both the TokenReview and token. An identifier is any identifier
     * in the intersection of the TokenReviewSpec audiences and the token's audiences.
     * A client of the TokenReview API that sets the spec.audiences field should
     * validate that a compatible audience identifier is returned in the
     * status.audiences field to ensure that the TokenReview server is audience aware.
     * If a TokenReview returns an empty status.audience field where
     * status.authenticated is "true", the token is valid against the audience of the
     * Kubernetes API server.
     */
    private StringList $audiences;

    /**
     * authenticated indicates that the token was associated with a known user.
     */
    private bool|null $authenticated = null;

    /**
     * error indicates that the token couldn't be checked
     */
    private string|null $error = null;

    /**
     * user is the UserInfo associated with the provided token.
     */
    private UserInfo|null $user = null;

    public function __construct()
    {
        $this->audiences = new StringList();
    }

    public function audiences(): StringList
    {
        return $this->audiences;
    }

    public function getAuthenticated(): bool|null
    {
        return $this->authenticated;
    }

    public function getError(): string|null
    {
        return $this->error;
    }

    public function getUser(): UserInfo|null
    {
        return $this->user;
    }

    public function setAudiences(StringList $audiences): self
    {
        $this->audiences = $audiences;

        return $this;
    }

    public function setAuthenticated(bool $authenticated): self
    {
        $this->authenticated = $authenticated;

        return $this;
    }

    public function setError(string $error): self
    {
        $this->error = $error;

        return $this;
    }

    public function setUser(UserInfo $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function user(): UserInfo
    {
        return $this->user ??= new UserInfo();
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'audiences' => $this->audiences,
            'authenticated' => $this->authenticated,
            'error' => $this->error,
            'user' => $this->user,
        ]);
    }
}
