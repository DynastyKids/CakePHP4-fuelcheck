<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AllstationsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AllstationsTable Test Case
 */
class AllstationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AllstationsTable
     */
    protected $Allstations;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Allstations',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Allstations') ? [] : ['className' => AllstationsTable::class];
        $this->Allstations = $this->getTableLocator()->get('Allstations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Allstations);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AllstationsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\AllstationsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
