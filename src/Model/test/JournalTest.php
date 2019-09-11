<?php


namespace Accounting\Model;


use Accounting\DB\DB;
use PHPUnit\Framework\TestCase;
use RedBeanPHP\R;

require_once "../../../vendor/autoload.php";

class JournalTest extends TestCase
{
    private $journal;

    protected function setUp(): void
    {
        if (!R::testConnection()) {
            DB::initialize();
        }
        R::begin();

        $this->journal = Journal::getInstance();
        $this->account = 'Porto und Gebuehren';
    }

    protected function tearDown(): void
    {
        R::rollback();
        R::close();
    }

    public function testAddEntry(): void
    {
        $journal = $this->journal;
        $entry = Entry::create(20.0, 'Briefmarken', $this->account, '123');
        $countBefore = count($journal->getEntries());
        Entry::create(15.0, 'Kuverts', $this->account, '456');
        $this->assertCount($countBefore + 1, $journal->getEntries());
    }

    public function testEntryIdStart(): void
    {
        $countBefore = count($this->journal->getEntries());
        $entry = Entry::create(20.0, 'Briefmarken', $this->account, '123');
        $this->assertEquals($countBefore+1, $entry->getId());
    }

    public function testEntryIdIncrement(): void
    {
        $countBefore = count($this->journal->getEntries());
        $entry1 = Entry::create(20.0, 'Briefmarken', $this->account, '123');
        $entry2 = Entry::create(20.0, 'Briefmarken', $this->account, '123');
        $this->assertEquals($countBefore+2, $entry2->getId());
    }
}
