<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClaseDeportistaTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClaseDeportistaTable Test Case
 */
class ClaseDeportistaTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ClaseDeportistaTable
     */
    public $ClaseDeportista;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ClaseDeportista',
        'app.Clase',
        'app.Usuario',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ClaseDeportista') ? [] : ['className' => ClaseDeportistaTable::class];
        $this->ClaseDeportista = TableRegistry::getTableLocator()->get('ClaseDeportista', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ClaseDeportista);

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
