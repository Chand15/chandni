<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Chandni\Product\Api\Data;

interface ProductInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const ENTITY_ID = 'entity_id';

    const SKU = 'sku';

    const VENDOR_NUMBER = 'vendor_number';
    
    const VENDOR_NOTE = 'vendor_note';

    /**
     * Get entity_id
     * @return string|null
     */
    public function getEntityId();

    /**
     * Set entity_id
     * @param string $entityId
     * @return \Chandni\Product\Api\Data\ProductInterface
     */
    public function setEntityId($entityId);

    /**
     * Get Sku
     * @return string|null
     */
    public function getSku();

    /**
     * Set Sku
     * @param string $sku
     * @return \Chandni\Product\Api\Data\ProductInterface
     */
    public function setSku($sku);

    /**
     * Get Sku
     * @return string|null
     */
    public function getVendorNumber();

    /**
     * Set vendor_number
     * @param string $vendorNumber
     * @return \Chandni\Product\Api\Data\ProductInterface
     */
    public function setVendorNumber($vendorNumber);

    /**
     * Get vendor_note
     * @return string|null
     */
    public function getVendorNote();

    /**
     * Set vendor_note
     * @param string $vendorNote
     * @return \Chandni\Product\Api\Data\ProductInterface
     */
    public function setVendorNote($vendorNote);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Chandni\Product\Api\Data\ProductExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Chandni\Product\Api\Data\ProductExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Chandni\Product\Api\Data\ProductExtensionInterface $extensionAttributes
    );
}

