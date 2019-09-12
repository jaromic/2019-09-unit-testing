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

    public function testEntryIdStart(): void
    {
        $journal = $this->journal;
        $entry = $this->getSingleTestEntry();
        $journal->addEntry($entry);
        $this->assertEquals(0, $entry->getId());
    }

    public function testEntryIdIncrement(): void
    {
        $entry = $this->getSingleTestEntry();
        $this->assertEquals(1, $entry->getId());
    }

    public function testIsIncomeOrExpense(): void {
        $entry = $this->getSingleTestEntry();
        $this->assertTrue($entry->isIncome() || $entry->isExpense());
    }

    public function testGetAmount(): void {
        $entry = $this->getSingleTestEntry();
        $this->assertEquals(20.0, $entry->getAmount());
    }

    /**
     * @return Entry
     */
    private function getSingleTestEntry(): Entry
    {
        $entry = new Entry(20.0,
            'Briefmarken',
            '7800',
            '123',
            false
        );
        return $entry;
    }
}
