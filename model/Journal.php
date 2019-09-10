<?php

namespace Accounting;


class Journal {

    /**
     * @var Entry[]
     */
    private $entries;

    /**
     * @return Entry[]
     */
    public function getEntries(): array
    {
        return $this->entries;
    }

    public function addEntry(Entry $entry) {
         array_push($this->entries, $entry);
    }


}