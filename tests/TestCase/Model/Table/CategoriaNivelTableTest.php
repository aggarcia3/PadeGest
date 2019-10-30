<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CategoriaNivelTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CategoriaNivelTable Test Case
 */
class CategoriaNivelTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CategoriaNivelTable
     */
    public $CategoriaNivel;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.CategoriaNivel'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CategoriaNivel') ? [] : ['className' => CategoriaNivelTable::class];
        $this->CategoriaNivel = TableRegistry::getTableLocator()->get('CategoriaNivel', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CategoriaNivel);

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
