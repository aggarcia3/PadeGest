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
        'usuario_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'partido_promocionado_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'FK_USUARIO_PARTIDO_PROMOCIONADO_PARTIDO_PROMOCIONADO_idx' => ['type' => 'index', 'columns' => ['partido_promocionado_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['usuario_id', 'partido_promocionado_id'], 'length' => []],
            'FK_USUARIO_PARTIDO_PROMOCIONADO_PARTIDO_PROMOCIONADO' => ['type' => 'foreign', 'columns' => ['partido_promocionado_id'], 'references' => ['partido_promocionado', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'FK_USUARIO_PARTIDO_PROMOCIONADO_USUARIO' => ['type' => 'foreign', 'columns' => ['usuario_id'], 'references' => ['usuario', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'usuario_id' => 1,
                'partido_promocionado_id' => 1,
            ],
        ];
        parent::init();
    }
}
