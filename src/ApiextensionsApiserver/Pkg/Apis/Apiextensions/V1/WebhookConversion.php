<?php

declare(strict_types=1);

namespace K8Schema\ApiextensionsApiserver\Pkg\Apis\Apiextensions\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringList;

/**
 * WebhookConversion describes how to call a conversion webhook
 */
class WebhookConversion implements JsonSerializable
{
    /**
     * clientConfig is the instructions for how to call the webhook if strategy is
     * `Webhook`.
     */
    private WebhookClientConfig|null $clientConfig = null;

    /**
     * conversionReviewVersions is an ordered list of preferred `ConversionReview`
     * versions the Webhook expects. The API server will use the first version in the
     * list which it supports. If none of the versions specified in this list are
     * supported by API server, conversion will fail for the custom resource. If a
     * persisted Webhook configuration specifies allowed versions and does not include
     * any versions known to the API Server, calls to the webhook will fail.
     */
    private StringList $conversionReviewVersions;

    public function __construct()
    {
        $this->conversionReviewVersions = new StringList();
    }

    public function clientConfig(): WebhookClientConfig
    {
        return $this->clientConfig ??= new WebhookClientConfig();
    }

    public function conversionReviewVersions(): StringList
    {
        return $this->conversionReviewVersions;
    }

    public function getClientConfig(): WebhookClientConfig|null
    {
        return $this->clientConfig;
    }

    public function setClientConfig(WebhookClientConfig $clientConfig): self
    {
        $this->clientConfig = $clientConfig;

        return $this;
    }

    public function setConversionReviewVersions(StringList $conversionReviewVersions): self
    {
        $this->conversionReviewVersions = $conversionReviewVersions;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'clientConfig' => $this->clientConfig,
            'conversionReviewVersions' => $this->conversionReviewVersions,
        ]);
    }
}
