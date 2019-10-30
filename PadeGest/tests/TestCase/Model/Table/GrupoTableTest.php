<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GrupoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GrupoTable Test Case
 */
class GrupoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\GrupoTable
     */
    public $Grupo;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Grupo'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Grupo') ? [] : ['className' => GrupoTable::class];
        $this->Grupo = TableRegistry::getTableLocator()->get('Grupo', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Grupo);

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
