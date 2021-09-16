<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Chandni\Product\Model\Data;

use Chandni\Product\Api\Data\ProductInterface;

class Product extends \Magento\Framework\Api\AbstractExtensibleObject implements ProductInterface
{

    /**
     * Get entity_id
     * @return string|null
     */
    public function getEntityId()
    {
        return $this->_get(self::ENTITY_ID);
    }

    /**
     * Set entity_id
     * @param string $entityId
     * @return \Chandni\Product\Api\Data\ProductInterface
     */
    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * Get Data
     * @return string|null
     */
    public function getSku()
    {
        return $this->_get(self::SKU);
    }

    /**
     * Set Data
     * @param string $data
     * @return \Chandni\Product\Api\Data\ProductInterface
     */
    public function setSku($sku)
    {
        return $this->setData(self::SKU, $sku);
    }

    /**
     * Get Data
     * @return string|null
     */
    public function getVendorNumber()
    {
        return $this->_get(self::VENDOR_NUMBER);
    }

    /**
     * Set vendor_number
     * @param string $vendorNumber
     * @return \Chandni\Product\Api\Data\ProductInterface
     */
    public function setVendorNumber($vendorNumber)
    {
        return $this->setData(self::VENDOR_NUMBER, $vendorNumber);
    }

    /**
     * Get vendor_note
     * @return string|null
     */
    public function getVendorNote()
    {
        return $this->_get(self::VENDOR_NOTE);
    }

    /**
     * Set vendor_note
     * @param string $vendorNote
     * @return \Chandni\Product\Api\Data\ProductInterface
     */
    public function setVendorNote($vendorNote)
    {
        return $this->setData(self::VENDOR_NOTE, $vendorNote);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Chandni\Product\Api\Data\ProductExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Chandni\Product\Api\Data\ProductExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Chandni\Product\Api\Data\ProductExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
}

