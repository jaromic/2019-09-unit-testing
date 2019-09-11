<?php


namespace Accounting\Model;

/* class is not yet in use */

class Account
{
    private $identifier;
    private $name;

    /**
     * Account constructor.
     * @param $identifier
     * @param $name
     */
    public function __construct($identifier, $name)
    {
        $this->identifier = $identifier;
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function calculateBalance(Journal $journal): float {
        $balance = 0.0;
        foreach($journal->getEntries as $entry) {
            if($entry->getAccount() && $entry->getAccount()->getName()) {
                $balance += $entry->getAmount();
            }
        }
        return $balance;
    }

}