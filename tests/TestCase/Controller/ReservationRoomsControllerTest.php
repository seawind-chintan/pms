<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ReservationRoomsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ReservationRoomsController Test Case
 */
class ReservationRoomsControllerTest extends IntegrationTestCase
{

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
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
