<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WaterparkRechargesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WaterparkRechargesTable Test Case
 */
class WaterparkRechargesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WaterparkRechargesTable
     */
    public $WaterparkRecharges;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.waterpark_recharges',
        'app.users',
        'app.user_roles',
        'app.user_details',
        'app.properties',
        'app.property_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('WaterparkRecharges') ? [] : ['className' => WaterparkRechargesTable::class];
        $this->WaterparkRecharges = TableRegistry::get('WaterparkRecharges', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->WaterparkRecharges);

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
