<?php

namespace Accounting\CLI;

require_once "../../vendor/autoload.php";

use Accounting\ExampleData\Creator;
use Accounting\Exception\ArgumentCountException;
use Accounting\Model\Entry;
use Accounting\Model\Journal;
use Exception;

class Act
{
    /**
     * @param string[] $argv
     * @return int
     */
    public static function main(): void
    {

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
                    case 'test':
                        self::createTestData();
                        break;
                    case 'exit':
                        $exitRequested = true;
                        break;
                    case 'help':
                        self::printHelp();
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

    /**
     * @param array $args
     * @throws ArgumentCountException
     */
    private static function postNewEntry(array $args): void
    {
        $expectedArgumentCount = 4;
        $usage = "post <amount> <description> <account> <invoiceNumber>";
        self::checkArgumentCount($args, $expectedArgumentCount, $usage);
        $amount = floatval($args[0]);
        $description = $args[1];
        $account = $args[2];
        $invoiceNumber = $args[3];
        $newEntry = new Entry ($amount, $description, $account, $invoiceNumber);
        Journal::getInstance()->addEntry($newEntry);
    }

    /**
     * @param array $args
     * @throws ArgumentCountException
     */
    private static function showExistingEntry(array $args): void
    {
        $expectedArgumentCount = 1;
        $usage = "show <id>";
        self::checkArgumentCount($args, $expectedArgumentCount, $usage);
        $id = intval($args[0]);
        $entry = Journal::getInstance()->getEntry($id);
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

    /**
     *
     */
    private static function createTestData(): void
    {
        Creator::run();
    }

    /**
     *
     */
    private static  function printHelp(): void
    {
        echo <<<END
Available Commands:
    journal  Print the journal with all entries
    show     Display existing entry
    post     Create a new entry
    merge    Merge two entries into one
    split    Split an entry into two
    report   Print a comprehensive report
    help     Show this help message
    test     Generate test data
    exit     Exit the program
END;
    }

}

Act::main();