<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WaterparkPricesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WaterparkPricesTable Test Case
 */
class WaterparkPricesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WaterparkPricesTable
     */
    public $WaterparkPrices;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.waterpark_prices',
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
        $config = TableRegistry::exists('WaterparkPrices') ? [] : ['className' => WaterparkPricesTable::class];
        $this->WaterparkPrices = TableRegistry::get('WaterparkPrices', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->WaterparkPrices);

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
