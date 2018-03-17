<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WaterparkTicketsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WaterparkTicketsTable Test Case
 */
class WaterparkTicketsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WaterparkTicketsTable
     */
    public $WaterparkTickets;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.waterpark_tickets',
        'app.properties',
        'app.property_types',
        'app.users',
        'app.user_roles',
        'app.user_details',
        'app.members',
        'app.packages',
        'app.member_groups',
        'app.reservations',
        'app.room_plans',
        'app.room_types',
        'app.rooms',
        'app.room_occupancies',
        'app.reservation_rooms',
        'app.cities',
        'app.states',
        'app.countries',
        'app.reservation_rates',
        'app.room_rates'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('WaterparkTickets') ? [] : ['className' => WaterparkTicketsTable::class];
        $this->WaterparkTickets = TableRegistry::get('WaterparkTickets', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->WaterparkTickets);

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
