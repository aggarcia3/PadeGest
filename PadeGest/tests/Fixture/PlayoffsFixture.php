<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PlayoffsFixture
 */
class PlayoffsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'idLigaRegular' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'nombreLigaRegular_UNIQUE' => ['type' => 'unique', 'columns' => ['idLigaRegular'], 'length' => []],
            'FK_PLAYOFFS_CAMPEONATO' => ['type' => 'foreign', 'columns' => ['id'], 'references' => ['campeonato', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'FK_PLAYOFFS_LIGA_REGULAR' => ['type' => 'foreign', 'columns' => ['idLigaRegular'], 'references' => ['liga_regular', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'idLigaRegular' => 1
            ],
        ];
        parent::init();
    }
}
