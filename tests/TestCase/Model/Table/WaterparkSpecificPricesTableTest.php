<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WaterparkSpecificPricesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WaterparkSpecificPricesTable Test Case
 */
class WaterparkSpecificPricesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WaterparkSpecificPricesTable
     */
    public $WaterparkSpecificPrices;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.waterpark_specific_prices',
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
        $config = TableRegistry::exists('WaterparkSpecificPrices') ? [] : ['className' => WaterparkSpecificPricesTable::class];
        $this->WaterparkSpecificPrices = TableRegistry::get('WaterparkSpecificPrices', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->WaterparkSpecificPrices);

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
