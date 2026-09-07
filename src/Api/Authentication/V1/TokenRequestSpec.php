<?php

declare(strict_types=1);

namespace K8Schema\Api\Authentication\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringList;
use K8Schema\Collection\StringListMap;

/**
 * TokenRequestSpec contains client provided parameters of a token request.
 */
class TokenRequestSpec implements JsonSerializable
{
    /**
     * attestations is a map of well-known keys to string-slice values. The values for
     * each key have a specific semantic meaning, which is documented on the key
     * definition. Requesters of tokens may ask the Kubernetes API Server to attest to
     * certain claims. The API Server may perform authorization checks depending on the
     * key of this map.
     */
    private StringListMap $attestations;

    /**
     * audiences are the intendend audiences of the token. A recipient of a token must
     * identify themself with an identifier in the list of audiences of the token, and
     * otherwise should reject the token. A token issued for multiple audiences may be
     * used to authenticate against any of the audiences listed but implies a high
     * degree of trust between the target audiences.
     */
    private StringList $audiences;

    /**
     * boundObjectRef is a reference to an object that the token will be bound to. The
     * token will only be valid for as long as the bound object exists. NOTE: The API
     * server's TokenReview endpoint will validate the BoundObjectRef, but other
     * audiences may not. Keep ExpirationSeconds small if you want prompt revocation.
     */
    private BoundObjectReference|null $boundObjectRef = null;

    /**
     * expirationSeconds is the requested duration of validity of the request. The
     * token issuer may return a token with a different validity duration so a client
     * needs to check the 'expiration' field in a response.
     */
    private int|null $expirationSeconds = null;

    public function __construct()
    {
        $this->attestations = new StringListMap();
        $this->audiences = new StringList();
    }

    public function attestations(): StringListMap
    {
        return $this->attestations;
    }

    public function audiences(): StringList
    {
        return $this->audiences;
    }

    public function boundObjectRef(): BoundObjectReference
    {
        return $this->boundObjectRef ??= new BoundObjectReference();
    }

    public function getBoundObjectRef(): BoundObjectReference|null
    {
        return $this->boundObjectRef;
    }

    public function getExpirationSeconds(): int|null
    {
        return $this->expirationSeconds;
    }

    public function setAttestations(StringListMap $attestations): self
    {
        $this->attestations = $attestations;

        return $this;
    }

    public function setAudiences(StringList $audiences): self
    {
        $this->audiences = $audiences;

        return $this;
    }

    public function setBoundObjectRef(BoundObjectReference $boundObjectRef): self
    {
        $this->boundObjectRef = $boundObjectRef;

        return $this;
    }

    public function setExpirationSeconds(int $expirationSeconds): self
    {
        $this->expirationSeconds = $expirationSeconds;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'attestations' => $this->attestations,
            'audiences' => $this->audiences,
            'boundObjectRef' => $this->boundObjectRef,
            'expirationSeconds' => $this->expirationSeconds,
        ]);
    }
}
