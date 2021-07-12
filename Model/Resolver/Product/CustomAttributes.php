<?php

declare(strict_types=1);

namespace DigitalPerception\CatalogGraphQl\Model\Resolver\Product;

use Magento\Catalog\Model\Product;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use DigitalPerception\CatalogGraphQl\Model\Product\Attributes\Collection as AttributesCollection;

/**
 * Retrieves CustomAttributes
 */
class CustomAttributes implements ResolverInterface
{

    /**
     * @var AttributesCollection
     */
    private $attributesCollection;

    /**
     * CustomAttributes constructor.
     * @param AttributesCollection $attributesCollection
     */
    public function __construct(
        AttributesCollection $attributesCollection
    ) {
        $this->attributesCollection = $attributesCollection;
    }
    /**
     * @inheritdoc
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        if (!isset($value['model'])) {
            throw new GraphQlInputException(__('Value must contain "model" property.'));
        }

        if (!isset($args['fields'])) {
            throw new GraphQlInputException(__('Input parameter "fields" is missing'));
        }
        /** @var Product $product */
        $product = $value['model'];
        $productId = $product->getId();

        $productAttributes = $this->attributesCollection->getAttributesValueByProductId((int) $productId);

        $data = array();
        foreach ($args['fields'] as $field) {
                $data[] = $productAttributes[$field];
        }
        return $data;
    }
}
