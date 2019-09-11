<?php

namespace Accounting\CLI;

use Accounting\model\Journal;

class Accounting
{
    /**
     * @param string[] $argv
     * @return int
     */
    public static function main(array $argv): int
    {
        $exitRequested = false;
        while(!$exitRequested) {
            echo "> ";
            $command = explode(" ", fgets(STDIN));
            switch($command[0]) {
                case 'journal':
                    self::printJournal();
                case 'exit':
                    $exitRequested = true;
                    break;
            }
        }
    }

    public static function printJournal(): void {
        echo Journal::getInstance() . "\n";
    }

}

main($argv);