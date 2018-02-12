<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RoomsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RoomsTable Test Case
 */
class RoomsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RoomsTable
     */
    public $Rooms;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.rooms'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Rooms') ? [] : ['className' => RoomsTable::class];
        $this->Rooms = TableRegistry::get('Rooms', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Rooms);

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
