<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PistaTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PistaTable Test Case
 */
class PistaTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PistaTable
     */
    public $Pista;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Pista'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Pista') ? [] : ['className' => PistaTable::class];
        $this->Pista = TableRegistry::getTableLocator()->get('Pista', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Pista);

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
