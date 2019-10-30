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
        'idPareja' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'idEnfrentamiento' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'participacionConfirmada' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'FK_PAREJA_ENFRENTAMIENTO_PAREJA_idx' => ['type' => 'index', 'columns' => ['idPareja'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['idEnfrentamiento', 'idPareja'], 'length' => []],
            'FK_PAREJA_ENFRENTAMIENTO_ENFRENTAMIENTO' => ['type' => 'foreign', 'columns' => ['idEnfrentamiento'], 'references' => ['enfrentamiento', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'FK_PAREJA_ENFRENTAMIENTO_PAREJA' => ['type' => 'foreign', 'columns' => ['idPareja'], 'references' => ['pareja', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'idPareja' => 1,
                'idEnfrentamiento' => 1,
                'participacionConfirmada' => 1
            ],
        ];
        parent::init();
    }
}
