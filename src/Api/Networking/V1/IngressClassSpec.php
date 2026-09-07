<?php

declare(strict_types=1);

namespace K8Schema\Api\Networking\V1;

use ArrayObject;
use JsonSerializable;

/**
 * IngressClassSpec provides information about the class of an Ingress.
 */
class IngressClassSpec implements JsonSerializable
{
    /**
     * controller refers to the name of the controller that should handle this class.
     * This allows for different "flavors" that are controlled by the same controller.
     * For example, you may have different parameters for the same implementing
     * controller. This should be specified as a domain-prefixed path no more than 250
     * characters in length, e.g. "acme.io/ingress-controller". This field is
     * immutable.
     */
    private string|null $controller = null;

    /**
     * parameters is a link to a custom resource containing additional configuration
     * for the controller. This is optional if the controller does not require extra
     * parameters.
     */
    private IngressClassParametersReference|null $parameters = null;

    public function __construct()
    {
    }

    public function getController(): string|null
    {
        return $this->controller;
    }

    public function getParameters(): IngressClassParametersReference|null
    {
        return $this->parameters;
    }

    public function setController(string $controller): self
    {
        $this->controller = $controller;

        return $this;
    }

    public function setParameters(IngressClassParametersReference $parameters): self
    {
        $this->parameters = $parameters;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'controller' => $this->controller,
            'parameters' => $this->parameters,
        ]);
    }
}
