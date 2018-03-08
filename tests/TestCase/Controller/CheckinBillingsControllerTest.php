<?php
namespace App\Test\TestCase\Controller;

use App\Controller\CheckinBillingsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\CheckinBillingsController Test Case
 */
class CheckinBillingsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.checkin_billings',
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
