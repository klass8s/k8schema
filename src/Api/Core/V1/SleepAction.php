<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use JsonSerializable;

/**
 * SleepAction describes a "sleep" action.
 */
class SleepAction implements JsonSerializable
{
    /**
     * Seconds is the number of seconds to sleep.
     */
    private int $seconds;

    public function __construct(int $seconds)
    {
        $this->seconds = $seconds;
    }

    public function getSeconds(): int
    {
        return $this->seconds;
    }

    public function setSeconds(int $seconds): self
    {
        $this->seconds = $seconds;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'seconds' => $this->seconds,
        ];
    }
}
