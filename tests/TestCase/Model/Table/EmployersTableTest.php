<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EmployersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EmployersTable Test Case
 */
class EmployersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EmployersTable
     */
    public $Employers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Employers',
        'app.Users',
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
        $config = TableRegistry::getTableLocator()->exists('Employers') ? [] : ['className' => EmployersTable::class];
        $this->Employers = TableRegistry::getTableLocator()->get('Employers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Employers);

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
