<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RoomPlansTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RoomPlansTable Test Case
 */
class RoomPlansTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RoomPlansTable
     */
    public $RoomPlans;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.room_plans',
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
        $config = TableRegistry::exists('RoomPlans') ? [] : ['className' => RoomPlansTable::class];
        $this->RoomPlans = TableRegistry::get('RoomPlans', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RoomPlans);

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
