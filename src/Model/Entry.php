<?php


namespace Accounting\Model;


class Entry
{

    private static $nextId = 0;

    /**
     * @var int;
     */
    private $id;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var string
     */
    private $description;
    /**
     * @var string
     */
    private $account;


    /**
     * @var string
     */
    private $invoiceNumber;

    public function __construct(float $amount, string $description, string $account, string $invoiceNumber)
    {
        $this->id =         $id = self::getNextId();

        $this->amount = $amount;
        $this->description = $description;
        $this->account = $account;
        $this->invoiceNumber = $invoiceNumber;
    }

    private static function getNextId(): int
    {
        $result = self::$nextId;
        self::$nextId += 1;
        return $result;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getAmount(): float
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
     * @return string
     */
    public function getAccount(): string
    {
        return $this->account;
    }

    /**
     * @return string
     */
    public function getInvoiceNumber(): string
    {
        return $this->invoiceNumber;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $output = "{$this->id}: {$this->amount} € for {$this->description} ({$this->invoiceNumber})";
        return $output;
    }

}