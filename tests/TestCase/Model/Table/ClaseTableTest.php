<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClaseTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClaseTable Test Case
 */
class ClaseTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ClaseTable
     */
    public $Clase;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Clase',
        'app.Reserva',
        'app.Usuario'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Clase') ? [] : ['className' => ClaseTable::class];
        $this->Clase = TableRegistry::getTableLocator()->get('Clase', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Clase);

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
