<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ParejaEnfrentamientoFixture
 */
class ParejaEnfrentamientoFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'pareja_enfrentamiento';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'pareja_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'enfrentamiento_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'participacionConfirmada' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'FK_PAREJA_ENFRENTAMIENTO_PAREJA_idx' => ['type' => 'index', 'columns' => ['pareja_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['enfrentamiento_id', 'pareja_id'], 'length' => []],
            'FK_PAREJA_ENFRENTAMIENTO_ENFRENTAMIENTO' => ['type' => 'foreign', 'columns' => ['enfrentamiento_id'], 'references' => ['enfrentamiento', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'FK_PAREJA_ENFRENTAMIENTO_PAREJA' => ['type' => 'foreign', 'columns' => ['pareja_id'], 'references' => ['pareja', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'pareja_id' => 1,
                'enfrentamiento_id' => 1,
                'participacionConfirmada' => 1,
            ],
        ];
        parent::init();
    }
}
