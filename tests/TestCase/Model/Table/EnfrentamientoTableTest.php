<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EnfrentamientoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EnfrentamientoTable Test Case
 */
class EnfrentamientoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EnfrentamientoTable
     */
    public $Enfrentamiento;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Enfrentamiento',
        'app.Pareja',
        'app.Reserva',
        'app.Resultado'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Enfrentamiento') ? [] : ['className' => EnfrentamientoTable::class];
        $this->Enfrentamiento = TableRegistry::getTableLocator()->get('Enfrentamiento', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Enfrentamiento);

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
