<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PistaFixture
 */
class PistaFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'pista';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'tipoSuelo' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'comment' => '', 'precision' => null, 'fixed' => null],
        'tipoCerramiento' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'comment' => '', 'precision' => null, 'fixed' => null],
        'localizacion' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'comment' => '', 'precision' => null, 'fixed' => null],
        'focos' => ['type' => 'tinyinteger', 'length' => 4, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
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
                'tipoSuelo' => 'moqueta',
                'tipoCerramiento' => 'cristal',
                'localizacion' => 'exterior',
                'focos' => 3
            ],
            [
                'id' => 2,
                'tipoSuelo' => 'cemento',
                'tipoCerramiento' => 'cristal',
                'localizacion' => 'interior',
                'focos' => 2
            ]
        ];
        parent::init();
    }
}
