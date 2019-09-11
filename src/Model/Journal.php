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
     * @var Entry[]
     */
    private $entries;

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

    /**
     * @param Entry $entry
     */
    public function addEntry(Entry $entry): void {
        array_push($this->entries, $entry);
    }

    /**
     * @param int $id
     * @return Entry|null
     */
    public function getEntry(int $id): ?Entry {
        $result = null;
        foreach($this->entries as $entry) {
            if($entry->getId()==$id) {
                $result = $entry;
                break;
            }
        }
        return $result;
    }

    /**
     * Journal constructor.
     */
    private function __construct()
    {
        $this->entries = [];
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