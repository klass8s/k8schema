<?php

declare(strict_types=1);

namespace K8Schema\Api\Networking\V1;

use ArrayObject;
use JsonSerializable;

/**
 * IngressSpec describes the Ingress the user wishes to exist.
 */
class IngressSpec implements JsonSerializable
{
    /**
     * defaultBackend is the backend that should handle requests that don't match any
     * rule. If Rules are not specified, DefaultBackend must be specified. If
     * DefaultBackend is not set, the handling of requests that do not match any of the
     * rules will be up to the Ingress controller.
     */
    private IngressBackend|null $defaultBackend = null;

    /**
     * ingressClassName is the name of an IngressClass cluster resource. Ingress
     * controller implementations use this field to know whether they should be serving
     * this Ingress resource, by a transitive connection (controller -> IngressClass ->
     * Ingress resource). Although the `kubernetes.io/ingress.class` annotation (simple
     * constant name) was never formally defined, it was widely supported by Ingress
     * controllers to create a direct binding between Ingress controller and Ingress
     * resources. Newly created Ingress resources should prefer using the field.
     * However, even though the annotation is officially deprecated, for backwards
     * compatibility reasons, ingress controllers should still honor that annotation if
     * present.
     */
    private string|null $ingressClassName = null;

    /**
     * rules is a list of host rules used to configure the Ingress. If unspecified, or
     * no rule matches, all traffic is sent to the default backend.
     */
    private IngressRuleList $rules;

    /**
     * tls represents the TLS configuration. Currently the Ingress only supports a
     * single TLS port, 443. If multiple members of this list specify different hosts,
     * they will be multiplexed on the same port according to the hostname specified
     * through the SNI TLS extension, if the ingress controller fulfilling the ingress
     * supports SNI.
     */
    private IngressTLSList $tls;

    public function __construct()
    {
        $this->rules = new IngressRuleList();
        $this->tls = new IngressTLSList();
    }

    public function defaultBackend(): IngressBackend
    {
        return $this->defaultBackend ??= new IngressBackend();
    }

    public function getDefaultBackend(): IngressBackend|null
    {
        return $this->defaultBackend;
    }

    public function getIngressClassName(): string|null
    {
        return $this->ingressClassName;
    }

    public function rules(): IngressRuleList
    {
        return $this->rules;
    }

    public function setDefaultBackend(IngressBackend $defaultBackend): self
    {
        $this->defaultBackend = $defaultBackend;

        return $this;
    }

    public function setIngressClassName(string $ingressClassName): self
    {
        $this->ingressClassName = $ingressClassName;

        return $this;
    }

    public function setRules(IngressRuleList $rules): self
    {
        $this->rules = $rules;

        return $this;
    }

    public function setTls(IngressTLSList $tls): self
    {
        $this->tls = $tls;

        return $this;
    }

    public function tls(): IngressTLSList
    {
        return $this->tls;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'defaultBackend' => $this->defaultBackend,
            'ingressClassName' => $this->ingressClassName,
            'rules' => $this->rules,
            'tls' => $this->tls,
        ]);
    }
}
