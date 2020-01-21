<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ParejaEnfrentamientoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ParejaEnfrentamientoTable Test Case
 */
class ParejaEnfrentamientoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ParejaEnfrentamientoTable
     */
    public $ParejaEnfrentamiento;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ParejaEnfrentamiento',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ParejaEnfrentamiento') ? [] : ['className' => ParejaEnfrentamientoTable::class];
        $this->ParejaEnfrentamiento = TableRegistry::getTableLocator()->get('ParejaEnfrentamiento', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ParejaEnfrentamiento);

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
