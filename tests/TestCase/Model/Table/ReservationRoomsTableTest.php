<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReservationRoomsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReservationRoomsTable Test Case
 */
class ReservationRoomsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReservationRoomsTable
     */
    public $ReservationRooms;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.reservation_rooms',
        'app.reservations',
        'app.members',
        'app.cities',
        'app.states',
        'app.countries',
        'app.rooms',
        'app.room_types',
        'app.users',
        'app.user_roles',
        'app.user_details',
        'app.properties',
        'app.property_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ReservationRooms') ? [] : ['className' => ReservationRoomsTable::class];
        $this->ReservationRooms = TableRegistry::get('ReservationRooms', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ReservationRooms);

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
