<?php

namespace Accounting\model;

use PHPUnit\Framework\TestCase;

require_once "../../../vendor/autoload.php";

class JournalTest extends TestCase
{
    private $journal;

    protected function setUp(): void
    {
        $this->journal = Journal::getInstance();
        $this->account = new Account('1', 'Porto und Gebuehren');
    }

    public function testAddEntry(): void
    {
        $journal = $this->journal;
        $entry = new Entry(20.0, 'Briefmarken', $this->account, '123');
        $this->assertCount(0, $journal->getEntries());
        $journal->addEntry($entry);
        $this->assertCount(1, $journal->getEntries());
    }

    public function testEntryIdStart(): void
    {
        $entry = new Entry(20.0, 'Briefmarken', $this->account, '123');
        $this->assertEquals(1, $entry->getId());
    }

    public function testEntryIdIncrement(): void
    {
        $entry1 = new Entry(20.0, 'Briefmarken', $this->account, '123');
        $entry2 = new Entry(20.0, 'Briefmarken', $this->account, '123');
        $this->assertEquals(2, $entry2->getId());
    }
}
