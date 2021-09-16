<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Chandni\Product\Model;

use Chandni\Product\Api\Data\ProductInterfaceFactory;
use Chandni\Product\Api\Data\ProductSearchResultsInterfaceFactory;
use Chandni\Product\Api\ProductRepositoryInterface;
use Chandni\Product\Model\ResourceModel\Product as ResourceProduct;
use Chandni\Product\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

class ProductRepository implements ProductRepositoryInterface
{

    protected $resource;

    protected $productFactory;

    protected $productCollectionFactory;

    protected $searchResultsFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $dataProductFactory;

    protected $extensionAttributesJoinProcessor;

    private $storeManager;

    private $collectionProcessor;

    protected $extensibleDataObjectConverter;

    public function __construct(
        ResourceProduct $resource,
        ProductFactory $productFactory,
        ProductInterfaceFactory $dataProductFactory,
        ProductCollectionFactory $productCollectionFactory,
        ProductSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->productFactory = $productFactory;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataProductFactory = $dataProductFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    public function save(
        \Chandni\Product\Api\Data\ProductInterface $product
    ) {
        /* if (empty($product->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $product->setStoreId($storeId);
        } */
        
        $productData = $this->extensibleDataObjectConverter->toNestedArray(
            $product,
            [],
            \Chandni\Product\Api\Data\ProductInterface::class
        );
        
        $productModel = $this->productFactory->create()->setData($productData);
        
        try {
            $this->resource->save($productModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the product: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    public function get($entityId)
    {
        $product = $this->productFactory->create();
        $this->resource->load($product, $entityId);
        if (!$product->getId()) {
            throw new NoSuchEntityException(__('Entity with id "%1" does not exist.', $entityId));
        }
        return $product->getDataModel();
    }

    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->productCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Chandni\Product\Api\Data\ProductInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    public function delete(
        \Chandni\Product\Api\Data\ProductInterface $product
    ) {
        try {
            $productModel = $this->productFactory->create();
            $this->resource->load($productModel, $product->getEntityId());
            $this->resource->delete($productModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Entity: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    public function deleteById($entityId)
    {
        return $this->delete($this->get($entityId));
    }
}

