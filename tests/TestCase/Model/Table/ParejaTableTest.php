<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ParejaTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ParejaTable Test Case
 */
class ParejaTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ParejaTable
     */
    public $Pareja;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Pareja',
        'app.Enfrentamiento'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Pareja') ? [] : ['className' => ParejaTable::class];
        $this->Pareja = TableRegistry::getTableLocator()->get('Pareja', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Pareja);

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
}
