<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\TemplateComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\TemplateComponent Test Case
 */
class TemplateComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\TemplateComponent
     */
    public $Template;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Template = new TemplateComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Template);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
