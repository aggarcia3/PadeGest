<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CategoriaNivelFixture
 */
class CategoriaNivelFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'categoria_nivel';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'categoria' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_bin', 'comment' => '', 'precision' => null, 'fixed' => null],
        'nivel' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_bin', 'comment' => '', 'precision' => null, 'fixed' => null],
        'campeonato_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'FK_CATEGORIA_NIVEL_CAMPEONATO_idx' => ['type' => 'index', 'columns' => ['campeonato_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'UNIQUE' => ['type' => 'unique', 'columns' => ['categoria', 'nivel', 'campeonato_id'], 'length' => []],
            'FK_CATEGORIA_NIVEL_CAMPEONATO' => ['type' => 'foreign', 'columns' => ['campeonato_id'], 'references' => ['campeonato', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'categoria' => 'Lorem ipsum dolor sit amet',
                'nivel' => 'Lorem ipsum dolor sit amet',
                'campeonato_id' => 1
            ],
        ];
        parent::init();
    }
}
