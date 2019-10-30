<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PlayoffsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PlayoffsTable Test Case
 */
class PlayoffsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PlayoffsTable
     */
    public $Playoffs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Playoffs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Playoffs') ? [] : ['className' => PlayoffsTable::class];
        $this->Playoffs = TableRegistry::getTableLocator()->get('Playoffs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Playoffs);

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
