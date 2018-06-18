<?php
namespace NG\Slider\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $tableName = $setup->getTable("ng_slider");
// check if table does not exist;
        if($setup->getConnection()->isTableExists($tableName) != true) {
            /**create table **/
            /** @var TYPE_NAME $table */
                $table = $setup->getConnection()->newTable($tableName)
                    ->addColumn(
                        'id',
                        Table::TYPE_INTEGER,
                        NULL,
                        ['identity' => true,
                            'unsigned' => true,
                            'primary' => true,
                            'nullable' => false
                        ],
                        'ID'
                    )
                    ->addColumn(
                        'image_url',
                        Table::TYPE_TEXT,
                        NULL,
                        [   'nullable' => true,
                            'default' => ''
                        ],
                        'Image url for slide'
                    )
                    ->addColumn(
                        'description',
                        Table::TYPE_TEXT,
                        NULL,
                        [
                            'nullable' => true,
                            'default' => ''
                        ],
                        'description for slide'
                    )
                    ->addColumn(
                        'position',
                        TABLE::TYPE_INTEGER,
                        11,
                        [
                            'nullable' => true,
                            'default' => 1
                        ],
                        'sorting order for slide'
                    )
                    ->setOption('type', 'InnoDB')
                    ->setOption('charset', 'utf8');
                $setup->getConnection()->createTable($table);
        }
        $setup->endSetup();
    }
}