<?php


use PHPUnit\Framework\TestCase;

class JournalTest extends TestCase
{
    private $journal;

    protected function setUp(): void
    {
        $this->journal = new Journal();
    }

    public function testAddEntry(): void
    {
        $account = new Account();
        $entry = new \Accounting\Entry(20.0, 'Briefmarken', );
        $journal->addEntry
    }

}
