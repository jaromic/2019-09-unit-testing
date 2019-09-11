<?php


namespace Accounting\Model;


use Accounting\DB\DB;
use Accounting\ExampleData\Creator;
use PHPUnit\Framework\TestCase;
use RedBeanPHP\R;

require_once "../../../vendor/autoload.php";

class JournalTest extends TestCase
{
    private $journal;

    protected function setUp(): void
    {

        $this->journal = Journal::getInstance();
        $this->account = 'Porto und Gebuehren';
        Creator::run();
    }

    protected function tearDown(): void
    {
    }

    public function testAddEntry(): void
    {
        $journal = $this->journal;
        $journal->addEntry(new Entry(20.0, 'Briefmarken', $this->account, '123'));
        $countBefore = count($journal->getEntries());
        $journal->addEntry(new Entry(15.0, 'Kuverts', $this->account, '456'));
        $this->assertCount($countBefore + 1, $journal->getEntries());
    }

}
