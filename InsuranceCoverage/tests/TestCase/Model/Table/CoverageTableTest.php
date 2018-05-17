<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CoverageTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CoverageTable Test Case
 */
class CoverageTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CoverageTable
     */
    public $Coverage;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.coverage'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Coverage') ? [] : ['className' => CoverageTable::class];
        $this->Coverage = TableRegistry::get('Coverage', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Coverage);

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
