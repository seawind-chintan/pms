<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RoomRatesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RoomRatesTable Test Case
 */
class RoomRatesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RoomRatesTable
     */
    public $RoomRates;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.room_rates',
        'app.users',
        'app.user_roles',
        'app.user_details',
        'app.properties',
        'app.property_types',
        'app.room_plans',
        'app.room_types',
        'app.rooms',
        'app.room_occupancies',
        'app.reservation_rooms',
        'app.reservations',
        'app.members',
        'app.packages',
        'app.member_groups',
        'app.cities',
        'app.states',
        'app.countries'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('RoomRates') ? [] : ['className' => RoomRatesTable::class];
        $this->RoomRates = TableRegistry::get('RoomRates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RoomRates);

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
