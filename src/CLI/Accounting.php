<?php

namespace Accounting\CLI;

require_once "../../vendor/autoload.php";

use Accounting\Exception\ArgumentCountException;
use Accounting\Model\Entry;
use Accounting\Model\Journal;
use Accounting\DB\DB;
use Exception;
use RedBeanPHP\R;

class Accounting
{
    /**
     * @param string[] $argv
     * @return int
     */
    public static function main(array $argv): void
    {
        self::initializeDatabase();

        $exitRequested = false;
        while (!$exitRequested) {
            echo "> ";

            list($command, $args) = self::getCommandInput();

            try {
                switch ($command) {
                    case 'journal':
                        self::printJournal();
                        break;
                    case 'post':
                        self::postNewEntry($args);
                        break;
                    case 'show':
                        self::showExistingEntry($args);
                        break;
                    case 'exit':
                        $exitRequested = true;
                        break;
                    default:
                        echo "Command not found.\n";
                        break;
                }
            } catch (Exception $e) {
                echo $e->getMessage() . "\n";
            }
        }
    }

    private static function printJournal(): void
    {
        echo Journal::getInstance() . "\n";
    }

    private static function postNewEntry(array $args): void
    {
        $expectedArgumentCount = 4;
        $usage = "post <amount> <description> <account> <invoiceNumber>";
        self::checkArgumentCount($args, $expectedArgumentCount, $usage);
        $amount = floatval($args[0]);
        $description = $args[1];
        $account = $args[2];
        $invoiceNumber = $args[3];
        $newEntry = Entry::create($amount, $description, $account, $invoiceNumber);
    }

    private static function showExistingEntry(array $args): void
    {
        $expectedArgumentCount = 1;
        $usage = "show <id>";
        self::checkArgumentCount($args, $expectedArgumentCount, $usage);
        $id = intval($args[0]);
        $entry = Entry::getById($id);
        echo "{$entry}\n";
    }

    /**
     * @return array
     */
    private static function getCommandInput(): array
    {
        $commandParts = explode(" ", fgets(STDIN));
        $command = trim($commandParts[0]);
        $args = array_slice($commandParts, 1);
        return array($command, $args);
    }

    /**
     * @param array $args
     * @param int $expectedArgumentCount
     * @throws ArgumentCountException
     */
    private static function checkArgumentCount(array $args, int $expectedArgumentCount, string $usage): void
    {
        $actualArgumentCount = count($args);
        if ($actualArgumentCount != $expectedArgumentCount) {
            throw new ArgumentCountException("Expected {$expectedArgumentCount} arguments, got {$actualArgumentCount}.\nUsage: {$usage}");
        }
    }

    private static function initializeDatabase(): void
    {
        DB::initialize();
    }

}

Accounting::main($argv);