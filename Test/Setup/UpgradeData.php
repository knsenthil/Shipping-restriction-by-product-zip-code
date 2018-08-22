<?php
namespace Tecnovators\Test\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements  UpgradeDataInterface
{
    /**
     * EAV setup factory
     *
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * Init
     *
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function upgrade(ModuleDataSetupInterface $setup,ModuleContextInterface $context) {
	
		$installer = $setup;

        $installer->startSetup();
        /** @var EavSetup $eavSetup */
        

        /**
         * Add attributes to the eav/attribute
         */
		 
		 
		if (version_compare($context->getVersion(), "1.0.0.0", "<")) {
        //Your upgrade script
        }
		if (version_compare($context->getVersion(), '1.0.0.2', '<')) {
			$eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
			$eavSetup->addAttribute(
				\Magento\Catalog\Model\Product::ENTITY,
				'product_restricted_zip',
				[
					'type' => 'varchar',
					'backend' => '',
					'frontend' => '',
					'label' => 'Restricted Zip Code',
					'input' => 'text',
					'class' => '',
					'source' => '',
					'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
					'visible' => true,
					'required' => false,
					'user_defined' => false,
					'default' => 0,
					'searchable' => true,
					'filterable' => false,
					'comparable' => false,
					'visible_on_front' => true,
					'used_in_product_listing' => true,
					'unique' => false,
					'apply_to' => ''
				]
			);
		}
		$installer->endSetup();
    }
}