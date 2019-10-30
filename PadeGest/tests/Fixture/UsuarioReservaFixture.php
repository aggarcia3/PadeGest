<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsuarioReservaFixture
 */
class UsuarioReservaFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'usuario_reserva';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'idUsuario' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'idReserva' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'FK_USUARIO_RESERVA_RESERVA_idx' => ['type' => 'index', 'columns' => ['idReserva'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['idUsuario', 'idReserva'], 'length' => []],
            'FK_USUARIO_RESERVA_RESERVA' => ['type' => 'foreign', 'columns' => ['idReserva'], 'references' => ['reserva', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'FK_USUARIO_RESERVA_USUARIO' => ['type' => 'foreign', 'columns' => ['idUsuario'], 'references' => ['usuario', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'idUsuario' => 1,
                'idReserva' => 1
            ],
        ];
        parent::init();
    }
}
