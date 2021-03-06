<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReservationRatesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReservationRatesTable Test Case
 */
class ReservationRatesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReservationRatesTable
     */
    public $ReservationRates;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.reservation_rates',
        'app.reservations',
        'app.members',
        'app.packages',
        'app.users',
        'app.user_roles',
        'app.user_details',
        'app.member_groups',
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
        $config = TableRegistry::exists('ReservationRates') ? [] : ['className' => ReservationRatesTable::class];
        $this->ReservationRates = TableRegistry::get('ReservationRates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ReservationRates);

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
