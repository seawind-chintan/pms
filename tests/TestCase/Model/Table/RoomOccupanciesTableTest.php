<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RoomOccupanciesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RoomOccupanciesTable Test Case
 */
class RoomOccupanciesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RoomOccupanciesTable
     */
    public $RoomOccupancies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.room_occupancies',
        'app.users',
        'app.user_roles',
        'app.user_details'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('RoomOccupancies') ? [] : ['className' => RoomOccupanciesTable::class];
        $this->RoomOccupancies = TableRegistry::get('RoomOccupancies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RoomOccupancies);

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
