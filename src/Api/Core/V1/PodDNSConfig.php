<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringList;

/**
 * PodDNSConfig defines the DNS parameters of a pod in addition to those generated
 * from DNSPolicy.
 */
class PodDNSConfig implements JsonSerializable
{
    /**
     * A list of DNS name server IP addresses. This will be appended to the base
     * nameservers generated from DNSPolicy. Duplicated nameservers will be removed.
     */
    private StringList $nameservers;

    /**
     * A list of DNS resolver options. This will be merged with the base options
     * generated from DNSPolicy. Duplicated entries will be removed. Resolution options
     * given in Options will override those that appear in the base DNSPolicy.
     */
    private PodDNSConfigOptionList $options;

    /**
     * A list of DNS search domains for host-name lookup. This will be appended to the
     * base search paths generated from DNSPolicy. Duplicated search paths will be
     * removed.
     */
    private StringList $searches;

    public function __construct()
    {
        $this->nameservers = new StringList();
        $this->options = new PodDNSConfigOptionList();
        $this->searches = new StringList();
    }

    public function nameservers(): StringList
    {
        return $this->nameservers;
    }

    public function options(): PodDNSConfigOptionList
    {
        return $this->options;
    }

    public function searches(): StringList
    {
        return $this->searches;
    }

    public function setNameservers(StringList $nameservers): self
    {
        $this->nameservers = $nameservers;

        return $this;
    }

    public function setOptions(PodDNSConfigOptionList $options): self
    {
        $this->options = $options;

        return $this;
    }

    public function setSearches(StringList $searches): self
    {
        $this->searches = $searches;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'nameservers' => $this->nameservers,
            'options' => $this->options,
            'searches' => $this->searches,
        ]);
    }
}
