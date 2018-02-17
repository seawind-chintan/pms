<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MemberGroupsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MemberGroupsTable Test Case
 */
class MemberGroupsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MemberGroupsTable
     */
    public $MemberGroups;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.member_groups',
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
        $config = TableRegistry::exists('MemberGroups') ? [] : ['className' => MemberGroupsTable::class];
        $this->MemberGroups = TableRegistry::get('MemberGroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MemberGroups);

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
