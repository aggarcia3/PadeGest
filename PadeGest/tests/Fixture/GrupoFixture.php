<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * GrupoFixture
 */
class GrupoFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'grupo';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'idCategoriaNivel' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'FK_GRUPO_CATEGORIA_NIVEL_idx' => ['type' => 'index', 'columns' => ['idCategoriaNivel'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'FK_GRUPO_CATEGORIA_NIVEL' => ['type' => 'foreign', 'columns' => ['idCategoriaNivel'], 'references' => ['categoria_nivel', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_bin'
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'idCategoriaNivel' => 1
            ],
        ];
        parent::init();
    }
}
