<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WaterparkIssuedBeltsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WaterparkIssuedBeltsTable Test Case
 */
class WaterparkIssuedBeltsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WaterparkIssuedBeltsTable
     */
    public $WaterparkIssuedBelts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.waterpark_issued_belts',
        'app.properties',
        'app.property_types',
        'app.waterpark_tickets',
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
        'app.room_rates',
        'app.waterpark_belts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('WaterparkIssuedBelts') ? [] : ['className' => WaterparkIssuedBeltsTable::class];
        $this->WaterparkIssuedBelts = TableRegistry::get('WaterparkIssuedBelts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->WaterparkIssuedBelts);

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
