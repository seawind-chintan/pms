<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RoomStatusesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RoomStatusesTable Test Case
 */
class RoomStatusesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RoomStatusesTable
     */
    public $RoomStatuses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.room_statuses'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('RoomStatuses') ? [] : ['className' => RoomStatusesTable::class];
        $this->RoomStatuses = TableRegistry::get('RoomStatuses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RoomStatuses);

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
}
