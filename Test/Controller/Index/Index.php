<?php
namespace Tecnovators\Test\Controller\Index;
use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
	protected $_objectManager;
	public $jsonHelper;
	public $resultFactory;
	
	
	public $product_restricted_zipcode = array();

	public function __construct(
		\Magento\Framework\ObjectManagerInterface $objectmanager,
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		\Magento\Framework\Json\Helper\Data $jsonHelper,
        \Magento\Framework\View\Result\PageFactory $resultFactory,
		array $data = [])
	{
		$this->_pageFactory = $pageFactory;
		$this->jsonHelper = $jsonHelper;
        $this->resultFactory = $resultFactory;
		return parent::__construct($context, $data);
		$this->_objectManager = $objectmanager;
		
	}

	public function execute()
	{
		$cart = $this->_objectManager->get('\Magento\Checkout\Model\Cart');
		// retrieve quote items array
		$items = $cart->getQuote()->getAllItems();
		foreach($items as $key => $item) {
			$product_data = $this->_objectManager->get('Magento\Catalog\Model\Product')->load($item->getProductId());
			if(!empty($product_data->getData('product_restricted_zip'))) {
				foreach(explode(",",$product_data->getData('product_restricted_zip')) as $zipcode) {
					$this->product_restricted_zipcode[] = $zipcode;
				} 
			}
		}
		if(in_array($this->getRequest()->getParam('zipcode'),$this->product_restricted_zipcode)) { 
			$return =  1;
		} else {
			$return = 0;
		}
		/** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        /** @var \Magento\Framework\Controller\Result\Raw $response */
        $response = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        $response->setHeader('Content-type', 'text/plain');
		$response->setContents($return);
		return $response;
	}
}