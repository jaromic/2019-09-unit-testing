<?php


class Buchung
{
    /**
     * @var int
     */
    private static $nextBuchung = 1;

    /**
     * @var int
     */
    private $id;

    /**
     * @var float
     */
    private $betrag;

    /**
     * @var string
     */
    private $bezeichnung;

    /**
     * @var bool
     */
    private $istEinnahme;

    private static function getNextId()
    {
        $nextId = self::$nextBuchung;
        self::$nextBuchung += 1;
        return $nextId;
    }

    /**
     * Buchung constructor.
     * @param float $betrag
     * @param string $bezeichnung
     * @param bool $istEinnahme
     */
    public function __construct(float $betrag, string $bezeichnung, bool $istEinnahme)
    {
        $this->id = self::getNextId();
        $this->betrag = $betrag;
        $this->bezeichnung = $bezeichnung;
        $this->istEinnahme = $istEinnahme;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

}