<?php
namespace NG\Slider\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

    class UpgradeSchema implements UpgradeSchemaInterface{

        /**
         * Upgrades DB schema for a module
         *
         * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
         * @param \Magento\Framework\Setup\ModuleContextInterface $context
         * @return void
         */
        public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
        {
            $setup->startSetup();
            $tableName = $setup->getTable("ng_slider");
            if($setup->getConnection()->isTableExists($tableName) == true AND version_compare($context->getVersion(), '1.0.1', '<')) {
                $table = $setup->getConnection();
                $table->addColumn(
                       $tableName,
                        'status',
                        [
                            'type' => Table::TYPE_INTEGER,
                            'length' => 1,
                            'nullable' => false,
                            'default' => 0,
                            'comment' => '1 = Active, 0 = Deactive'
                        ]
                    );
            }
            $setup->endSetup();
        }
    }