<?php


namespace Accounting\Model;


use RedBeanPHP\OODBBean;

class Journal
{

    /**
     * @var Journal|null
     */
    private static $instance;

    /**
     * @var OODBBean[]
     */
    private $ownEntryList;

    public static function getInstance(): Journal
    {
        if (!self::$instance) {
            self::$instance = new Journal();
        }
        return self::$instance;
    }


    /**
     * @return Entry[]
     */
    public function getEntries(): array
    {
        return Entry::getAll();
    }

    private function __construct()
    {
    }

    public function __toString()
    {
        $string = "Journal:\n";
        foreach($this->getEntries() as $entry) {
            $string .= "  " . $entry . "\n";
        }
        return $string;
    }

}