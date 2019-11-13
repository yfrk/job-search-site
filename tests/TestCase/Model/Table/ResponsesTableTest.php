<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ResponsesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ResponsesTable Test Case
 */
class ResponsesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ResponsesTable
     */
    public $Responses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Responses',
        'app.Employees',
        'app.Vacancies'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Responses') ? [] : ['className' => ResponsesTable::class];
        $this->Responses = TableRegistry::getTableLocator()->get('Responses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Responses);

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
