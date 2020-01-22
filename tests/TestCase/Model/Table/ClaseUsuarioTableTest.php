<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClaseUsuarioTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClaseUsuarioTable Test Case
 */
class ClaseUsuarioTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ClaseUsuarioTable
     */
    public $ClaseUsuario;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ClaseUsuario',
        'app.Clase',
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
        $config = TableRegistry::getTableLocator()->exists('ClaseUsuario') ? [] : ['className' => ClaseUsuarioTable::class];
        $this->ClaseUsuario = TableRegistry::getTableLocator()->get('ClaseUsuario', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ClaseUsuario);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
