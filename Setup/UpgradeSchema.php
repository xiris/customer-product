<?php namespace Xiris\CustomerProduct\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements  UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup,
                            ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $connection = $installer->getConnection();

        $connection->addColumn(
                'catalog_product_entity',
                'user_id',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    'nullable' => false,
                    'unsigned' => true,
                    'comment' => 'User id'
                ]
            );
        $connection->addForeignKey(
            $setup->getFkName(
                'catalog_product_entity',
                'user_id',
                'admin_user',
                'user_id'
            ),
            'catalog_product_entity',
            'user_id',
            $setup->getTable('admin_user'),
            'user_id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        );

        $setup->endSetup();
    }
}