<?php
namespace App\Test\TestCase\Controller;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\PistaController Test Case
 *
 * @uses \App\Controller\PistaController
 */
class PistaControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Pista'
    ];

    /**
     * Does initial setup for every test of this class
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->enableCsrfToken();

        // Admin user stub
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => 1,
                    'username' => 'administrador',
                    'rol' => 'administrador'
                ]
            ]
        ]);
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get(['controller' => 'pista']);
        $this->assertResponseOk();
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->post('/pista/add', [
            'tipoSuelo' => 'moqueta',
            'tipoCerramiento' => 'cristal',
            'localizacion' => 'exterior',
            'focos' => '5'
        ]);

        // Test appropriate response
        $this->assertFlashElement('Flash/success');
        $this->assertRedirect(['controller' => 'pista']);

        // Test that the entity persisted in the database
        $entityRows = TableRegistry::getTableLocator()->get('pista')->find()->where([
            'id' => '3'
        ])->count();
        $this->assertEquals(1, $entityRows);
    }

    /**
     * Test add method with invalid data
     *
     * @return void
     */
    public function testAddInvalid()
    {
        $this->post('/pista/add', [
            'id' => '10',
            'tipoSuelo' => 'cielo',
            'tipoCerramiento' => 'abierto',
            'localizacion' => 'espacio',
            'focos' => '-5'
        ]);

        // Test appropriate response
        $this->assertResponseOk();

        // Test that the entity did not persist in the database
        $entityRows = TableRegistry::getTableLocator()->get('pista')->find()->where([
            'id' => '10'
        ])->count();
        $this->assertEquals(0, $entityRows);
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->post('/pista/edit/1', [
            'tipoSuelo' => 'moqueta',
            'tipoCerramiento' => 'pared',
            'localizacion' => 'interior',
            'focos' => '0'
        ]);

        // Test appropriate response
        $this->assertRedirect(['controller' => 'pista']);
        $this->assertFlashElement('Flash/success');

        // Test that the entity persisted in the database
        $entityRows = TableRegistry::getTableLocator()->get('pista')->find()->where([
            'id' => '1',
            'tipoSuelo' => 'moqueta',
            'tipoCerramiento' => 'pared',
            'localizacion' => 'interior',
            'focos' => '0'
        ])->count();
        $this->assertEquals(1, $entityRows);
    }

    /**
     * Test edit method with invalid track data
     *
     * @return void
     */
    public function testEditInvalid()
    {
        $this->post('/pista/edit/1', [
            'tipoSuelo' => 'cielo',
            'tipoCerramiento' => 'abierto',
            'localizacion' => 'espacio',
            'focos' => '-5'
        ]);

        // Test appropriate response
        $this->assertResponseOk();

        // Test that the entity did not persist in the database
        $entityRows = TableRegistry::getTableLocator()->get('pista')->find()->where([
            'id' => '1',
            'tipoSuelo' => 'cielo',
            'tipoCerramiento' => 'abierto',
            'localizacion' => 'espacio',
            'focos' => '-5'
        ])->count();
        $this->assertEquals(0, $entityRows);
    }

    /**
     * Test edit method of not existing track
     *
     * @return void
     */
    public function testEditInexistent()
    {
        $this->post('/pista/edit/27');

        $this->assertRedirect(['controller' => 'pista']);
        $this->assertFlashElement('Flash/error');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->post('/pista/delete/1');

        $this->assertRedirect(['controller' => 'pista']);
        $this->assertFlashElement('Flash/success');
    }

    /**
     * Test delete method of not existing track
     *
     * @return void
     */
    public function testDeleteInvalid()
    {
        $this->post('/pista/delete/27');

        $this->assertRedirect(['controller' => 'pista']);
        $this->assertFlashElement('Flash/success');
    }
}
