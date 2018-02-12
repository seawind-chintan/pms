<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RoomTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RoomTypesTable Test Case
 */
class RoomTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RoomTypesTable
     */
    public $RoomTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.room_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('RoomTypes') ? [] : ['className' => RoomTypesTable::class];
        $this->RoomTypes = TableRegistry::get('RoomTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RoomTypes);

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
