<?php

namespace Accounting;

class Entry
{
    /**
     * @var int
     */
    private static $maxId = 0;

    /**
     * @var int;
     */
    private $id;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var description
     */
    private $description;
    /**
     * @var Account
     */
    private $account;

    /**
     * @var string
     */
    private $invoiceNumber;

    /**
     * Entry constructor.
     * @param $amount
     * @param $description
     * @param $account
     * @param $invoiceNumber
     */
    public function __construct($amount, $description, $account, $invoiceNumber)
    {
        $this->id = self::getNextId();
        $this->amount = $amount;
        $this->description = $description;
        $this->account = $account;
        $this->invoiceNumber = $invoiceNumber;
    }

    /**
     * @return int
     */
    public static function getNextId(): int
    {
        $newId = self::$maxId;
        self::$maxId += 1;
        return $newId;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @return mixed
     */
    public function getInvoiceNumber()
    {
        return $this->invoiceNumber;
    }


}