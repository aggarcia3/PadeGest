<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsuarioPartidoPromocionadoFixture
 */
class UsuarioPartidoPromocionadoFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'usuario_partido_promocionado';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'idUsuario' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'idPartidoPromocionado' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'FK_USUARIO_PARTIDO_PROMOCIONADO_PARTIDO_PROMOCIONADO_idx' => ['type' => 'index', 'columns' => ['idPartidoPromocionado'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['idUsuario', 'idPartidoPromocionado'], 'length' => []],
            'FK_USUARIO_PARTIDO_PROMOCIONADO_PARTIDO_PROMOCIONADO' => ['type' => 'foreign', 'columns' => ['idPartidoPromocionado'], 'references' => ['partido_promocionado', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'FK_USUARIO_PARTIDO_PROMOCIONADO_USUARIO' => ['type' => 'foreign', 'columns' => ['idUsuario'], 'references' => ['usuario', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'idPartidoPromocionado' => 1
            ],
        ];
        parent::init();
    }
}
