<?php

namespace Accounting\Model;

use PHPUnit\Framework\TestCase;

class EntryTest extends TestCase
{

    public function testEntryIdStart(): void
    {
        $journal = $this->journal;
        $entry = new Entry(20.0, 'Briefmarken', $this->account, '123');
        $journal->addEntry($entry);
        $this->assertEquals(count($journal->getEntries())+1, $entry->getId());
    }

    public function testEntryIdIncrement(): void
    {
        $journal = $this->journal;
        $countBefore = count($this->journal->getEntries());
        $entry1 = new Entry(20.0, 'Briefmarken', $this->account, '123');
        $entry2 = new Entry(20.0, 'Briefmarken', $this->account, '123');
        $this->assertEquals($countBefore+2, $entry2->getId());
    }
}
