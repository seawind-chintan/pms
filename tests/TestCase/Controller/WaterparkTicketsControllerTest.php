<?php
namespace App\Test\TestCase\Controller;

use App\Controller\WaterparkTicketsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\WaterparkTicketsController Test Case
 */
class WaterparkTicketsControllerTest extends IntegrationTestCase
{

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
