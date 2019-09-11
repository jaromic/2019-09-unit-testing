<?php

namespace Accounting\model;

class Journal
{

    /**
     * @var Entry[]
     */
    private $entries;

    /**
     * @var Journal|null
     */
    private static $instance;

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
        return $this->entries;
    }

    public function addEntry(Entry $entry)
    {
        array_push($this->entries, $entry);
    }

    private function __construct()
    {
        $this->entries = [];
    }

    public function __toString()
    {
        return "(Journal)";
    }

}