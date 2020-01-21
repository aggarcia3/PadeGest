<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ParejaFixture
 */
class ParejaFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'pareja';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'idCapitan' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'idCompanero' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'categoria_nivel_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'grupo_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'FK_PAREJA_GRUPO_idx' => ['type' => 'index', 'columns' => ['grupo_id'], 'length' => []],
            'FK_PAREJA_CATEGORIA_NIVEL_idx' => ['type' => 'index', 'columns' => ['categoria_nivel_id'], 'length' => []],
            'FK_PAREJA_USUARIO1' => ['type' => 'index', 'columns' => ['idCapitan'], 'length' => []],
            'FK_PAREJA_USUARIO2' => ['type' => 'index', 'columns' => ['idCompanero'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'FK_PAREJA_CATEGORIA_NIVEL' => ['type' => 'foreign', 'columns' => ['categoria_nivel_id'], 'references' => ['categoria_nivel', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'FK_PAREJA_GRUPO' => ['type' => 'foreign', 'columns' => ['grupo_id'], 'references' => ['grupo', 'id'], 'update' => 'cascade', 'delete' => 'setNull', 'length' => []],
            'FK_PAREJA_USUARIO1' => ['type' => 'foreign', 'columns' => ['idCapitan'], 'references' => ['usuario', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'FK_PAREJA_USUARIO2' => ['type' => 'foreign', 'columns' => ['idCompanero'], 'references' => ['usuario', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_bin'
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
                'idCapitan' => 1,
                'idCompanero' => 1,
                'categoria_nivel_id' => 1,
                'grupo_id' => 1,
            ],
        ];
        parent::init();
    }
}
