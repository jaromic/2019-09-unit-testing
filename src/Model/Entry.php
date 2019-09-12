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
    private $grossAmount;

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

    /**
     * @var bool
     */
    private $isIncome;

    /**
     * @var int
     */
    private $tax;

    /**
     * Entry constructor.
     * @param float $amount
     * @param string $description
     * @param string $account
     * @param string $invoiceNumber
     */
    public function __construct(float $amount,
                                string $description,
                                string $account,
                                string $invoiceNumber,
                                bool $isIncome,
                                int $tax)
    {
        $this->id = self::getNextId();
        $this->grossAmount = $amount;
        $this->description = $description;
        $this->account = $account;
        $this->invoiceNumber = $invoiceNumber;
        $this->isIncome = $isIncome;
        $this->tax = $tax;
    }

    /**
     * @return int
     */
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
    public function getGrossAmount(): float
    {
        return $this->grossAmount;
    }

    /**
     * @return float
     */
    public function getNetAmount(): float
    {
        return $this->grossAmount / (100 + $this->tax) * 100;
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
        if ($this->isIncome) {
            $incomeOrExpense = 'Income';
        } else {
            $incomeOrExpense = 'Expense';
        }
        $output = "{$incomeOrExpense} {$this->id}: {$this->grossAmount} € for {$this->description} ({$this->invoiceNumber})";
        return $output;
    }

    /**
     * @return bool
     */
    public function isIncome(): bool
    {
        return $this->isIncome;
    }

    /**
     * @return bool
     */
    public function isExpense(): bool
    {
        return !$this->isIncome;
    }

    /**
     * @return int
     */
    public function getTax(): int
    {
        return $this->tax;
    }

}