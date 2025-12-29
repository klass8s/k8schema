<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use JsonSerializable;

/**
 * ContainerRestartRule describes how a container exit is handled.
 */
class ContainerRestartRule implements JsonSerializable
{
    /**
     * Specifies the action taken on a container exit if the requirements are
     * satisfied. The only possible value is "Restart" to restart the container.
     */
    private string $action;

    /**
     * Represents the exit codes to check on container exits.
     */
    private ContainerRestartRuleOnExitCodes|null $exitCodes = null;

    public function __construct(string $action)
    {
        $this->action = $action;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getExitCodes(): ContainerRestartRuleOnExitCodes|null
    {
        return $this->exitCodes;
    }

    public function setAction(string $action): self
    {
        $this->action = $action;

        return $this;
    }

    public function setExitCodes(ContainerRestartRuleOnExitCodes $exitCodes): self
    {
        $this->exitCodes = $exitCodes;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'action' => $this->action,
            'exitCodes' => $this->exitCodes,
        ];
    }
}
