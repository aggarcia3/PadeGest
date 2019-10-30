<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReservaTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReservaTable Test Case
 */
class ReservaTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ReservaTable
     */
    public $Reserva;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::getTableLocator()->exists('Reserva') ? [] : ['className' => ReservaTable::class];
        $this->Reserva = TableRegistry::getTableLocator()->get('Reserva', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Reserva);

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
