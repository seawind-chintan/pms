<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CheckinStatusesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CheckinStatusesTable Test Case
 */
class CheckinStatusesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CheckinStatusesTable
     */
    public $CheckinStatuses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.checkin_statuses'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CheckinStatuses') ? [] : ['className' => CheckinStatusesTable::class];
        $this->CheckinStatuses = TableRegistry::get('CheckinStatuses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CheckinStatuses);

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
