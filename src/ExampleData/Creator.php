<?php


namespace Accounting\ExampleData;


use Accounting\Model\Entry;
use Accounting\Model\Journal;

class Creator
{
    public static function run()
    {
        $journal = Journal::getInstance();
        $journal->addEntry(new Entry(5, 'Briefmarken', 'Porto/Gebuehren', 'PO39485'));
        $journal->addEntry(new Entry(365, 'Wr. Linien Jahreskarte', 'Reisespesen', 'WL5200/1208/180'));
        $journal->addEntry(new Entry(120, 'Verbund Strom Akonto', 'sonstige', 'VB402201-0038-22293'));
    }
}