<?php

declare(strict_types=1);

namespace K8Schema\Api\Authentication\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringList;

/**
 * TokenRequestSpec contains client provided parameters of a token request.
 */
class TokenRequestSpec implements JsonSerializable
{
    /**
     * Audiences are the intendend audiences of the token. A recipient of a token must
     * identify themself with an identifier in the list of audiences of the token, and
     * otherwise should reject the token. A token issued for multiple audiences may be
     * used to authenticate against any of the audiences listed but implies a high
     * degree of trust between the target audiences.
     */
    private StringList $audiences;

    /**
     * BoundObjectRef is a reference to an object that the token will be bound to. The
     * token will only be valid for as long as the bound object exists. NOTE: The API
     * server's TokenReview endpoint will validate the BoundObjectRef, but other
     * audiences may not. Keep ExpirationSeconds small if you want prompt revocation.
     */
    private BoundObjectReference|null $boundObjectRef = null;

    /**
     * ExpirationSeconds is the requested duration of validity of the request. The
     * token issuer may return a token with a different validity duration so a client
     * needs to check the 'expiration' field in a response.
     */
    private int|null $expirationSeconds = null;

    public function __construct()
    {
        $this->audiences = new StringList();
    }

    public function audiences(): StringList
    {
        return $this->audiences;
    }

    public function boundObjectRef(): BoundObjectReference
    {
        return $this->boundObjectRef ??= new BoundObjectReference();
    }

    public function getExpirationSeconds(): int|null
    {
        return $this->expirationSeconds;
    }

    public function setExpirationSeconds(int $expirationSeconds): self
    {
        $this->expirationSeconds = $expirationSeconds;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'audiences' => $this->audiences,
            'boundObjectRef' => $this->boundObjectRef,
            'expirationSeconds' => $this->expirationSeconds,
        ]);
    }
}
