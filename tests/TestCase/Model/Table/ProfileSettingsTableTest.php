<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProfileSettingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProfileSettingsTable Test Case
 */
class ProfileSettingsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProfileSettingsTable
     */
    public $ProfileSettings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.profile_settings'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ProfileSettings') ? [] : ['className' => ProfileSettingsTable::class];
        $this->ProfileSettings = TableRegistry::get('ProfileSettings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProfileSettings);

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
