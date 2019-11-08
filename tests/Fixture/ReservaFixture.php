<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ReservaFixture
 */
class ReservaFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'reserva';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'fecha' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'pista_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'usuario_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'FK_PISTA_idx' => ['type' => 'index', 'columns' => ['pista_id'], 'length' => []],
            'FK_RESERVA_USUARIO_idx' => ['type' => 'index', 'columns' => ['usuario_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'UNIQUE' => ['type' => 'unique', 'columns' => ['fecha', 'pista_id'], 'length' => []],
            'FK_RESERVA_PISTA' => ['type' => 'foreign', 'columns' => ['pista_id'], 'references' => ['pista', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'FK_RESERVA_USUARIO' => ['type' => 'foreign', 'columns' => ['usuario_id'], 'references' => ['usuario', 'id'], 'update' => 'cascade', 'delete' => 'setNull', 'length' => []],
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
                'fecha' => '2019-11-01 18:28:40',
                'pista_id' => 1,
                'usuario_id' => 1
            ],
        ];
        parent::init();
    }
}
