<?php

declare(strict_types=1);

namespace K8Schema\ApiextensionsApiserver\Pkg\Apis\Apiextensions\V1;

use ArrayObject;
use JsonSerializable;

/**
 * CustomResourceSubresourceStatus defines how to serve the status subresource for
 * CustomResources. Status is represented by the `.status` JSON path inside of a
 * CustomResource. When set, * exposes a /status subresource for the custom
 * resource * PUT requests to the /status subresource take a custom resource
 * object, and ignore changes to anything except the status stanza * PUT/POST/PATCH
 * requests to the custom resource ignore changes to the status stanza
 */
class CustomResourceSubresourceStatus implements JsonSerializable
{
    public function __construct()
    {
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
        ]);
    }
}
