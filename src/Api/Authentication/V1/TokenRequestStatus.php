<?php

declare(strict_types=1);

namespace K8Schema\Api\Authentication\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\DateTimeInterface;

/**
 * TokenRequestStatus is the result of a token request.
 */
class TokenRequestStatus implements JsonSerializable
{
    /**
     * expirationTimestamp is the time of expiration of the returned token.
     */
    private DateTimeInterface|null $expirationTimestamp = null;

    /**
     * token is the opaque bearer token.
     */
    private string|null $token = null;

    public function __construct()
    {
    }

    public function getExpirationTimestamp(): DateTimeInterface|null
    {
        return $this->expirationTimestamp;
    }

    public function getToken(): string|null
    {
        return $this->token;
    }

    public function setExpirationTimestamp(DateTimeInterface $expirationTimestamp): self
    {
        $this->expirationTimestamp = $expirationTimestamp;

        return $this;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'expirationTimestamp' => $this->expirationTimestamp,
            'token' => $this->token,
        ]);
    }
}
