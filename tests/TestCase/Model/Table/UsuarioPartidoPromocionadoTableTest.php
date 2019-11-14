<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsuarioPartidoPromocionadoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsuarioPartidoPromocionadoTable Test Case
 */
class UsuarioPartidoPromocionadoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UsuarioPartidoPromocionadoTable
     */
    public $UsuarioPartidoPromocionado;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.UsuarioPartidoPromocionado',
        'app.Usuario',
        'app.PartidoPromocionado'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('UsuarioPartidoPromocionado') ? [] : ['className' => UsuarioPartidoPromocionadoTable::class];
        $this->UsuarioPartidoPromocionado = TableRegistry::getTableLocator()->get('UsuarioPartidoPromocionado', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UsuarioPartidoPromocionado);

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
