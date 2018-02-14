<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PropertyImagesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PropertyImagesTable Test Case
 */
class PropertyImagesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PropertyImagesTable
     */
    public $PropertyImages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.property_images',
        'app.properties'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PropertyImages') ? [] : ['className' => PropertyImagesTable::class];
        $this->PropertyImages = TableRegistry::get('PropertyImages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PropertyImages);

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
