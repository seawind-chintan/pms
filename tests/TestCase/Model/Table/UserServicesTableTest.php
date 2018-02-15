<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserServicesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserServicesTable Test Case
 */
class UserServicesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UserServicesTable
     */
    public $UserServices;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.user_services',
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
        $config = TableRegistry::exists('UserServices') ? [] : ['className' => UserServicesTable::class];
        $this->UserServices = TableRegistry::get('UserServices', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserServices);

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
