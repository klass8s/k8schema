<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * SessionAffinityConfig represents the configurations of session affinity.
 */
class SessionAffinityConfig implements JsonSerializable
{
    /**
     * clientIP contains the configurations of Client IP based session affinity.
     */
    private ClientIPConfig|null $clientIP = null;

    public function __construct()
    {
    }

    public function clientIP(): ClientIPConfig
    {
        return $this->clientIP ??= new ClientIPConfig();
    }

    public function getClientIP(): ClientIPConfig|null
    {
        return $this->clientIP;
    }

    public function setClientIP(ClientIPConfig $clientIP): self
    {
        $this->clientIP = $clientIP;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'clientIP' => $this->clientIP,
        ]);
    }
}
