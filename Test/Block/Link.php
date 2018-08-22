<?php
namespace Tecnovators\Test\Block;
class Link extends \Magento\Framework\View\Element\Template
{
	private $_objectManager;
	/**
	* Render block HTML.
	*
	* @return string
	*/
	
	public function __construct(\Magento\Framework\ObjectManagerInterface $objectmanager,
	\Magento\Framework\View\Element\Template\Context $context,
	 array $data = []
	)
	{
		parent::__construct($context, $data);
		$this->_objectManager = $objectmanager;
	}
	
	//set template for the block
	protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->setTemplate('Tecnovators_Test::custom_link.phtml');
        return $this;
    }
		
	// get the newly added item
	public function getLatestProduct(){
		$productCollection = $this->_objectManager->create('Magento\Catalog\Model\ResourceModel\Product\CollectionFactory');
		$collection = $productCollection->create()
			->addAttributeToSelect('*')
			->addAttributeToFilter('status',\Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED)
			->addAttributeToSort('entity_id','desc')
			->setPageSize(4)->load();
		return $collection;
	}
}