<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\LabelSelector;
use K8Schema\Collection\StringList;

/**
 * Defines a set of pods (namely those matching the labelSelector relative to the
 * given namespace(s)) that this pod should be co-located (affinity) or not
 * co-located (anti-affinity) with, where co-located is defined as running on a
 * node whose value of the label with key <topologyKey> matches that of any node on
 * which a pod of the set of pods is running
 */
class PodAffinityTerm implements JsonSerializable
{
    /**
     * A label query over a set of resources, in this case pods. If it's null, this
     * PodAffinityTerm matches with no Pods.
     */
    private LabelSelector|null $labelSelector = null;

    /**
     * MatchLabelKeys is a set of pod label keys to select which pods will be taken
     * into consideration. The keys are used to lookup values from the incoming pod
     * labels, those key-value labels are merged with `labelSelector` as `key in
     * (value)` to select the group of existing pods which pods will be taken into
     * consideration for the incoming pod's pod (anti) affinity. Keys that don't exist
     * in the incoming pod labels will be ignored. The default value is empty. The same
     * key is forbidden to exist in both matchLabelKeys and labelSelector. Also,
     * matchLabelKeys cannot be set when labelSelector isn't set.
     */
    private StringList $matchLabelKeys;

    /**
     * MismatchLabelKeys is a set of pod label keys to select which pods will be taken
     * into consideration. The keys are used to lookup values from the incoming pod
     * labels, those key-value labels are merged with `labelSelector` as `key notin
     * (value)` to select the group of existing pods which pods will be taken into
     * consideration for the incoming pod's pod (anti) affinity. Keys that don't exist
     * in the incoming pod labels will be ignored. The default value is empty. The same
     * key is forbidden to exist in both mismatchLabelKeys and labelSelector. Also,
     * mismatchLabelKeys cannot be set when labelSelector isn't set.
     */
    private StringList $mismatchLabelKeys;

    /**
     * A label query over the set of namespaces that the term applies to. The term is
     * applied to the union of the namespaces selected by this field and the ones
     * listed in the namespaces field. null selector and null or empty namespaces list
     * means "this pod's namespace". An empty selector ({}) matches all namespaces.
     */
    private LabelSelector|null $namespaceSelector = null;

    /**
     * namespaces specifies a static list of namespace names that the term applies to.
     * The term is applied to the union of the namespaces listed in this field and the
     * ones selected by namespaceSelector. null or empty namespaces list and null
     * namespaceSelector means "this pod's namespace".
     */
    private StringList $namespaces;

    /**
     * This pod should be co-located (affinity) or not co-located (anti-affinity) with
     * the pods matching the labelSelector in the specified namespaces, where
     * co-located is defined as running on a node whose value of the label with key
     * topologyKey matches that of any node on which any of the selected pods is
     * running. Empty topologyKey is not allowed.
     */
    private string $topologyKey;

    public function __construct(string $topologyKey)
    {
        $this->matchLabelKeys = new StringList();
        $this->mismatchLabelKeys = new StringList();
        $this->namespaces = new StringList();
        $this->topologyKey = $topologyKey;
    }

    public function getTopologyKey(): string
    {
        return $this->topologyKey;
    }

    public function labelSelector(): LabelSelector
    {
        return $this->labelSelector ??= new LabelSelector();
    }

    public function matchLabelKeys(): StringList
    {
        return $this->matchLabelKeys;
    }

    public function mismatchLabelKeys(): StringList
    {
        return $this->mismatchLabelKeys;
    }

    public function namespaceSelector(): LabelSelector
    {
        return $this->namespaceSelector ??= new LabelSelector();
    }

    public function namespaces(): StringList
    {
        return $this->namespaces;
    }

    public function setTopologyKey(string $topologyKey): self
    {
        $this->topologyKey = $topologyKey;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'labelSelector' => $this->labelSelector,
            'matchLabelKeys' => $this->matchLabelKeys,
            'mismatchLabelKeys' => $this->mismatchLabelKeys,
            'namespaceSelector' => $this->namespaceSelector,
            'namespaces' => $this->namespaces,
            'topologyKey' => $this->topologyKey,
        ]);
    }
}
