<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VacanciesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VacanciesTable Test Case
 */
class VacanciesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VacanciesTable
     */
    public $Vacancies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Vacancies',
        'app.Employers',
        'app.Responses',
        'app.Vtags'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Vacancies') ? [] : ['className' => VacanciesTable::class];
        $this->Vacancies = TableRegistry::getTableLocator()->get('Vacancies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Vacancies);

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
