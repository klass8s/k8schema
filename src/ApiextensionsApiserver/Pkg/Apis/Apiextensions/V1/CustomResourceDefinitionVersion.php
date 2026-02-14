<?php

declare(strict_types=1);

namespace K8Schema\ApiextensionsApiserver\Pkg\Apis\Apiextensions\V1;

use ArrayObject;
use JsonSerializable;

/**
 * CustomResourceDefinitionVersion describes a version for CRD.
 */
class CustomResourceDefinitionVersion implements JsonSerializable
{
    /**
     * additionalPrinterColumns specifies additional columns returned in Table output.
     * See
     * https://kubernetes.io/docs/reference/using-api/api-concepts/#receiving-resources-as-tables
     * for details. If no columns are specified, a single column displaying the age of
     * the custom resource is used.
     */
    private CustomResourceColumnDefinitionList $additionalPrinterColumns;

    /**
     * deprecated indicates this version of the custom resource API is deprecated. When
     * set to true, API requests to this version receive a warning header in the server
     * response. Defaults to false.
     */
    private bool|null $deprecated = null;

    /**
     * deprecationWarning overrides the default warning returned to API clients. May
     * only be set when `deprecated` is true. The default warning indicates this
     * version is deprecated and recommends use of the newest served version of equal
     * or greater stability, if one exists.
     */
    private string|null $deprecationWarning = null;

    /**
     * name is the version name, e.g. “v1”, “v2beta1”, etc. The custom
     * resources are served under this version at `/apis/<group>/<version>/...` if
     * `served` is true.
     */
    private string $name;

    /**
     * schema describes the schema used for validation, pruning, and defaulting of this
     * version of the custom resource.
     */
    private CustomResourceValidation|null $schema = null;

    /**
     * selectableFields specifies paths to fields that may be used as field selectors.
     * A maximum of 8 selectable fields are allowed. See
     * https://kubernetes.io/docs/concepts/overview/working-with-objects/field-selectors
     */
    private SelectableFieldList $selectableFields;

    /**
     * served is a flag enabling/disabling this version from being served via REST APIs
     */
    private bool $served;

    /**
     * storage indicates this version should be used when persisting custom resources
     * to storage. There must be exactly one version with storage=true.
     */
    private bool $storage;

    /**
     * subresources specify what subresources this version of the defined custom
     * resource have.
     */
    private CustomResourceSubresources|null $subresources = null;

    public function __construct(string $name, bool $served, bool $storage)
    {
        $this->additionalPrinterColumns = new CustomResourceColumnDefinitionList();
        $this->name = $name;
        $this->selectableFields = new SelectableFieldList();
        $this->served = $served;
        $this->storage = $storage;
    }

    public function additionalPrinterColumns(): CustomResourceColumnDefinitionList
    {
        return $this->additionalPrinterColumns;
    }

    public function getDeprecated(): bool|null
    {
        return $this->deprecated;
    }

    public function getDeprecationWarning(): string|null
    {
        return $this->deprecationWarning;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getServed(): bool
    {
        return $this->served;
    }

    public function getStorage(): bool
    {
        return $this->storage;
    }

    public function schema(): CustomResourceValidation
    {
        return $this->schema ??= new CustomResourceValidation();
    }

    public function selectableFields(): SelectableFieldList
    {
        return $this->selectableFields;
    }

    public function setDeprecated(bool $deprecated): self
    {
        $this->deprecated = $deprecated;

        return $this;
    }

    public function setDeprecationWarning(string $deprecationWarning): self
    {
        $this->deprecationWarning = $deprecationWarning;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setServed(bool $served): self
    {
        $this->served = $served;

        return $this;
    }

    public function setStorage(bool $storage): self
    {
        $this->storage = $storage;

        return $this;
    }

    public function subresources(): CustomResourceSubresources
    {
        return $this->subresources ??= new CustomResourceSubresources();
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'additionalPrinterColumns' => $this->additionalPrinterColumns,
            'deprecated' => $this->deprecated,
            'deprecationWarning' => $this->deprecationWarning,
            'name' => $this->name,
            'schema' => $this->schema,
            'selectableFields' => $this->selectableFields,
            'served' => $this->served,
            'storage' => $this->storage,
            'subresources' => $this->subresources,
        ]);
    }
}
