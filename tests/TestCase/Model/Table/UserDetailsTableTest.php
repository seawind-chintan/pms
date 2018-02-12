<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserDetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserDetailsTable Test Case
 */
class UserDetailsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UserDetailsTable
     */
    public $UserDetails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.user_details',
        'app.users',
        'app.user_roles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UserDetails') ? [] : ['className' => UserDetailsTable::class];
        $this->UserDetails = TableRegistry::get('UserDetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserDetails);

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
