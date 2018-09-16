<?php

 /*
 * NG_Slider
 * @category   Banner Slider
 * @package    NG_Slider
 * @license    OSL-v3.0
 * @version    1.0.0
 */

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
    /*
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $tableName = $setup->getTable("ng_slider");
        if ($setup->getConnection()->isTableExists($tableName) != true) {
            /*
             * create table
             * @var TYPE_NAME $table
             */
            try {
                $table = $setup->getConnection()->newTable($tableName)
                    ->addColumn(
                        'id',
                        Table::TYPE_INTEGER,
                        null,
                        ['identity' => true,
                            'unsigned' => true,
                            'primary' => true,
                            'nullable' => false
                        ],
                        'ID'
                    )
                    ->addColumn(
                        'image',
                        Table::TYPE_TEXT,
                        null,
                        ['nullable' => true,
                            'default' => ''
                        ],
                        'Image url for slide'
                    )
                    ->addColumn(
                        'description',
                        Table::TYPE_TEXT,
                        null,
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
            } catch (\Zend_Db_Exception $e) {
                return $e;
            }
            try {
                $setup->getConnection()->createTable($table);
            } catch (\Zend_Db_Exception $e) {
                return $e;
            }
        }
        $setup->endSetup();
        return true;
    }
}
