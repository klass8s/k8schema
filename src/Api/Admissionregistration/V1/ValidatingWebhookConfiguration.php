<?php

declare(strict_types=1);

namespace K8Schema\Api\Admissionregistration\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * ValidatingWebhookConfiguration describes the configuration of and admission
 * webhook that accept or reject and object without changing it.
 */
class ValidatingWebhookConfiguration implements APIResourceInterface
{
    public const string API_VERSION = 'admissionregistration.k8s.io/v1';
    public const string KIND = 'ValidatingWebhookConfiguration';

    /**
     * Standard object metadata; More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata.
     */
    private ObjectMeta|null $metadata = null;

    /**
     * Webhooks is a list of webhooks and the affected resources and operations.
     */
    private ValidatingWebhookList $webhooks;

    public function __construct()
    {
        $this->webhooks = new ValidatingWebhookList();
    }

    public function getMetadata(): ObjectMeta|null
    {
        return $this->metadata;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata ??= new ObjectMeta();
    }

    public function setMetadata(ObjectMeta $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    public function setWebhooks(ValidatingWebhookList $webhooks): self
    {
        $this->webhooks = $webhooks;

        return $this;
    }

    public function webhooks(): ValidatingWebhookList
    {
        return $this->webhooks;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
            'webhooks' => $this->webhooks,
        ]);
    }
}
