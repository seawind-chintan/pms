<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CheckinBillingTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CheckinBillingTable Test Case
 */
class CheckinBillingTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CheckinBillingTable
     */
    public $CheckinBilling;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.checkin_billing',
        'app.checkins',
        'app.members',
        'app.packages',
        'app.users',
        'app.user_roles',
        'app.user_details',
        'app.member_groups',
        'app.reservations',
        'app.properties',
        'app.property_types',
        'app.room_plans',
        'app.room_types',
        'app.rooms',
        'app.room_occupancies',
        'app.reservation_rooms',
        'app.cities',
        'app.states',
        'app.countries',
        'app.checkin_rooms_rates',
        'app.room_rates',
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
        $config = TableRegistry::exists('CheckinBilling') ? [] : ['className' => CheckinBillingTable::class];
        $this->CheckinBilling = TableRegistry::get('CheckinBilling', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CheckinBilling);

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
