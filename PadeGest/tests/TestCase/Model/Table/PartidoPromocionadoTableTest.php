<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PartidoPromocionadoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PartidoPromocionadoTable Test Case
 */
class PartidoPromocionadoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PartidoPromocionadoTable
     */
    public $PartidoPromocionado;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.PartidoPromocionado',
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
        $config = TableRegistry::getTableLocator()->exists('PartidoPromocionado') ? [] : ['className' => PartidoPromocionadoTable::class];
        $this->PartidoPromocionado = TableRegistry::getTableLocator()->get('PartidoPromocionado', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PartidoPromocionado);

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
