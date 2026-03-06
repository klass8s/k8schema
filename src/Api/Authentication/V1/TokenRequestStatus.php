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
     * ExpirationTimestamp is the time of expiration of the returned token.
     */
    private DateTimeInterface $expirationTimestamp;

    /**
     * Token is the opaque bearer token.
     */
    private string $token;

    public function __construct(DateTimeInterface $expirationTimestamp, string $token)
    {
        $this->expirationTimestamp = $expirationTimestamp;
        $this->token = $token;
    }

    public function getExpirationTimestamp(): DateTimeInterface
    {
        return $this->expirationTimestamp;
    }

    public function getToken(): string
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
