<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CampeonatoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CampeonatoTable Test Case
 */
class CampeonatoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CampeonatoTable
     */
    public $Campeonato;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Campeonato'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Campeonato') ? [] : ['className' => CampeonatoTable::class];
        $this->Campeonato = TableRegistry::getTableLocator()->get('Campeonato', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Campeonato);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
