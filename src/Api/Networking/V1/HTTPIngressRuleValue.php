<?php

declare(strict_types=1);

namespace K8Schema\Api\Networking\V1;

use JsonSerializable;

/**
 * HTTPIngressRuleValue is a list of http selectors pointing to backends. In the
 * example: http://<host>/<path>?<searchpart> -> backend where where parts of the
 * url correspond to RFC 3986, this resource will be used to match against
 * everything after the last '/' and before the first '?' or '#'.
 */
class HTTPIngressRuleValue implements JsonSerializable
{
    /**
     * paths is a collection of paths that map requests to backends.
     */
    private HTTPIngressPathList $paths;

    public function __construct()
    {
        $this->paths = new HTTPIngressPathList();
    }

    public function paths(): HTTPIngressPathList
    {
        return $this->paths;
    }

    public function jsonSerialize(): array
    {
        return [
            'paths' => $this->paths,
        ];
    }
}
