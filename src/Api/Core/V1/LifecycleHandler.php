<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * LifecycleHandler defines a specific action that should be taken in a lifecycle
 * hook. One and only one of the fields, except TCPSocket must be specified.
 */
class LifecycleHandler implements JsonSerializable
{
    /**
     * Exec specifies a command to execute in the container.
     */
    private ExecAction|null $exec = null;

    /**
     * HTTPGet specifies an HTTP GET request to perform.
     */
    private HTTPGetAction|null $httpGet = null;

    /**
     * Sleep represents a duration that the container should sleep.
     */
    private SleepAction|null $sleep = null;

    /**
     * Deprecated. TCPSocket is NOT supported as a LifecycleHandler and kept for
     * backward compatibility. There is no validation of this field and lifecycle hooks
     * will fail at runtime when it is specified.
     */
    private TCPSocketAction|null $tcpSocket = null;

    public function __construct()
    {
    }

    public function exec(): ExecAction
    {
        return $this->exec ??= new ExecAction();
    }

    public function getHttpGet(): HTTPGetAction|null
    {
        return $this->httpGet;
    }

    public function getSleep(): SleepAction|null
    {
        return $this->sleep;
    }

    public function getTcpSocket(): TCPSocketAction|null
    {
        return $this->tcpSocket;
    }

    public function setHttpGet(HTTPGetAction $httpGet): self
    {
        $this->httpGet = $httpGet;

        return $this;
    }

    public function setSleep(SleepAction $sleep): self
    {
        $this->sleep = $sleep;

        return $this;
    }

    public function setTcpSocket(TCPSocketAction $tcpSocket): self
    {
        $this->tcpSocket = $tcpSocket;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'exec' => $this->exec,
            'httpGet' => $this->httpGet,
            'sleep' => $this->sleep,
            'tcpSocket' => $this->tcpSocket,
        ]);
    }
}
