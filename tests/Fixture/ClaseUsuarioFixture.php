<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ClaseUsuarioFixture
 */
class ClaseUsuarioFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'clase_usuario';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'clase_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'usuario_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'FK_USUARIO_idx' => ['type' => 'index', 'columns' => ['usuario_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['clase_id', 'usuario_id'], 'length' => []],
            'FK_CLASE' => ['type' => 'foreign', 'columns' => ['clase_id'], 'references' => ['clase', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'FK_USUARIO' => ['type' => 'foreign', 'columns' => ['usuario_id'], 'references' => ['usuario', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'clase_id' => 1,
                'usuario_id' => 1,
            ],
        ];
        parent::init();
    }
}
