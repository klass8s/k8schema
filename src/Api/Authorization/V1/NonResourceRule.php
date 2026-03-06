<?php

declare(strict_types=1);

namespace K8Schema\Api\Authorization\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringList;

/**
 * NonResourceRule holds information that describes a rule for the non-resource
 */
class NonResourceRule implements JsonSerializable
{
    /**
     * NonResourceURLs is a set of partial urls that a user should have access to.  *s
     * are allowed, but only as the full, final step in the path.  "*" means all.
     */
    private StringList $nonResourceURLs;

    /**
     * Verb is a list of kubernetes non-resource API verbs, like: get, post, put,
     * delete, patch, head, options.  "*" means all.
     */
    private StringList $verbs;

    public function __construct()
    {
        $this->nonResourceURLs = new StringList();
        $this->verbs = new StringList();
    }

    public function nonResourceURLs(): StringList
    {
        return $this->nonResourceURLs;
    }

    public function setNonResourceURLs(StringList $nonResourceURLs): self
    {
        $this->nonResourceURLs = $nonResourceURLs;

        return $this;
    }

    public function setVerbs(StringList $verbs): self
    {
        $this->verbs = $verbs;

        return $this;
    }

    public function verbs(): StringList
    {
        return $this->verbs;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'nonResourceURLs' => $this->nonResourceURLs,
            'verbs' => $this->verbs,
        ]);
    }
}
