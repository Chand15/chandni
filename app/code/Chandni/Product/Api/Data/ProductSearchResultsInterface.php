<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Chandni\Product\Api\Data;

interface ProductSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Product list.
     * @return \Chandni\Product\Api\Data\ProductInterface[]
     */
    public function getItems();

    /**
     * Set Data list.
     * @param \Chandni\Product\Api\Data\ProductInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

