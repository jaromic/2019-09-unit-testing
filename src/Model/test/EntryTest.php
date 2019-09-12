<?php

namespace Accounting\Model;

use PHPUnit\Framework\TestCase;

class EntryTest extends TestCase
{

    private $journal;

    public function setUp() {
        echo __METHOD__."\n";
        $this->journal = Journal::getInstance();
    }

    public static function setUpBeforeClass() {
        echo __METHOD__."\n";
    }

    public function tearDown() {

    }

    public static function tearDownAfterClass() {

    }

    public function testEntryIdStart(): void
    {
        $journal = $this->journal;
        $entry = $this->getSingleTestExpenseEntry();
        $journal->addEntry($entry);
        $this->assertEquals(0, $entry->getId());
    }

    public function testEntryIdIncrement(): void
    {
        $entry = $this->getSingleTestExpenseEntry();
        $this->assertEquals(1, $entry->getId());
    }

    public function testIsIncomeOrExpense(): void {
        $entry = $this->getSingleTestExpenseEntry();
        $this->assertTrue($entry->isIncome() || $entry->isExpense());
    }

    public function testGetGrossAmount(): void {
        $entry = $this->getSingleTestExpenseEntry();
        $this->assertEquals(20.0, $entry->getGrossAmount());
    }

    public function test__toStringExpense(): void {
        $entry = $this->getSingleTestExpenseEntry();
        $this->assertEquals('Expense 4: 20 € for Briefmarken (123)', $entry->__toString());
    }

    public function test__toStringIncome(): void {
        $entry = $this->getSingleTestIncomeEntry();
        $this->assertEquals('Income 5: 20 € for Dienstleistung (123)', $entry->__toString());
    }

    public function testGetNetAmount(): void {
        $entry = $this->getSingleTestExpenseEntry();
        $this->assertEquals(20.0/1.2, $entry->getNetAmount());
    }

    /**
     * @return Entry
     */
    private function getSingleTestExpenseEntry(): Entry
    {
        $entry = new Entry(20.0,
            'Briefmarken',
            '7800',
            '123',
            false,
            20
        );
        return $entry;
    }

    /**
     * @return Entry
     */
    private function getSingleTestIncomeEntry(): Entry
    {
        $entry = new Entry(20.0,
            'Dienstleistung',
            '5800',
            '123',
            true,
            20
        );
        return $entry;
    }

}
