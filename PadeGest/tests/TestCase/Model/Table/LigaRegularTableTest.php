<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LigaRegularTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LigaRegularTable Test Case
 */
class LigaRegularTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LigaRegularTable
     */
    public $LigaRegular;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.LigaRegular'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('LigaRegular') ? [] : ['className' => LigaRegularTable::class];
        $this->LigaRegular = TableRegistry::getTableLocator()->get('LigaRegular', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LigaRegular);

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
