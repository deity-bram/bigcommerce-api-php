<?php

namespace Bigcommerce\Api\Resources;

use Bigcommerce\Api\Resource;
use Bigcommerce\Api\Client;

/**
 * Represents a single product.
 */
class Product extends Resource
{
    protected $ignoreOnCreate = array(
        'date_created',
        'date_modified',
    );

    /**
     * @see https://developer.bigcommerce.com/display/API/Products#Products-ReadOnlyFields
     * @var array
     */
    protected $ignoreOnUpdate = array(
        'id',
        'rating_total',
        'rating_count',
        'date_created',
        'date_modified',
        'date_last_imported',
        'number_sold',
        'brand',
        'images',
        'discount_rules',
        'configurable_fields',
        'custom_fields',
        'videos',
        'skus',
        'rules',
        'option_set',
        'options',
        'tax_class',
    );

    protected $ignoreIfZero = array(
        'tax_class_id',
    );

    public function brand()
    {
        return Client::getResource($this->fields->brand->resource, 'Brand');
    }

    public function images()
    {
        return Client::getCollection('/catalog/products/' . $this->id . '/images', 'ProductImage',Client::VERSION3);
    }

    public function skus()
    {
        return Client::getCollection($this->fields->skus->resource, 'Sku');
    }

    public function rules()
    {
        return Client::getCollection($this->fields->rules->resource, 'Rule');
    }

    public function videos()
    {
        return Client::getCollection('/catalog/products/' . $this->id . '/videos', 'ProductVideo',Client::VERSION3);
    }

    public function custom_fields()
    {
        return Client::getCollection('/catalog/products/' . $this->id . '/custom-fields', 'ProductCustomField',Client::VERSION3);
//        return Client::getCollection($this->fields->custom_fields->resource, 'ProductCustomField');
    }

    public function configurable_fields()
    {
        return Client::getCollection($this->fields->configurable_fields->resource, 'ProductConfigurableField');
    }

    public function discount_rules()
    {
        return Client::getCollection($this->fields->discount_rules->resource, 'DiscountRule');
    }

    public function option_set()
    {
        return Client::getResource($this->fields->option_set->resource, 'OptionSet');
    }

    public function options()
    {
        return Client::getCollection('/catalog/products/' . $this->id . '/options', 'ProductOption',Client::VERSION3);
    }

    public function create()
    {
        return Client::createProduct($this->getCreateFields());
    }

    public function update()
    {
        return Client::updateProduct($this->id, $this->getUpdateFields());
    }

    public function delete()
    {
        return Client::deleteProduct($this->id);
    }

    public function tax_class()
    {
        return Client::getResource($this->fields->tax_class->resource, 'TaxClass');
    }

    public function variants()
    {
        return Client::getCollection('/catalog/products/' . $this->id . '/variants', 'Resource',Client::VERSION3);
    }
}
