<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ResultadoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ResultadoTable Test Case
 */
class ResultadoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ResultadoTable
     */
    public $Resultado;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Resultado',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Resultado') ? [] : ['className' => ResultadoTable::class];
        $this->Resultado = TableRegistry::getTableLocator()->get('Resultado', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Resultado);

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
