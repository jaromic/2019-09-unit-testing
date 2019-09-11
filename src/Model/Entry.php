<?php


namespace Accounting\Model;


use RedBeanPHP\R;

class Entry
{

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

    private function __construct(int $id, float $amount, string $description, string $account, string $invoiceNumber)
    {
        $this->id = $id;
        $this->amount = $amount;
        $this->description = $description;
        $this->account = $account;
        $this->invoiceNumber = $invoiceNumber;

    }

    /**
     * @param float $amount
     * @param string $description
     * @param string $account
     * @param string $invoiceNumber
     * @return Entry
     */
    public static function create(float $amount, string $description, string $account, string $invoiceNumber): Entry
    {
        $entryRecord = R::dispense('entry');
        $entryRecord->amount = $amount;
        $entryRecord->description = $description;
        $entryRecord->account = $account;
        $entryRecord->invoiceNumber = $invoiceNumber;

        $id = intval(R::store($entryRecord));

        return new Entry($id, $amount, $description, $account, $invoiceNumber);

    }

    /**
     * @return Entry[]
     */
    public static function getAll(): array
    {
        $result = [];
        $resultRecords = R::find('entry');
        foreach ($resultRecords as $resultRecord) {
            array_push($result, self::instantiateFromRecord($resultRecord));
        }
        return $result;
    }

    /**
     * @param int $id
     * @return Entry|null
     */
    public static function getById(int $id): ?Entry
    {
        $entryRecord = R::load('entry', $id);
        return self::instantiateFromRecord($entryRecord);
    }

    /**
     * @param \RedBeanPHP\OODBBean $entryRecord
     * @return Entry|null
     */
    private static function instantiateFromRecord(\RedBeanPHP\OODBBean $entryRecord)
    {
        if ($entryRecord->id != 0) {
            $result = new Entry(
                intval($entryRecord->id),
                floatval($entryRecord->amount),
                trim($entryRecord->description),
                trim($entryRecord->account),
                trim($entryRecord->invoiceNumber)
            );
        } else {
            $result = null;
        }
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