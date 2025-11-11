<?php

namespace App\Command;

use App\Services\Import\Enum\ImportType;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:import',
    description: 'Importing files',
)]
class ImportCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('file', InputArgument::REQUIRED, 'File to import')
            ->addOption('type', null, InputOption::VALUE_REQUIRED, 'Type of import')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $file = $input->getArgument('file');
        $type = ImportType::tryFrom($input->getOption('type'));

        if ($type === null) {
            $io->error('Invalid type option! Possible values: ' . implode(', ', ImportType::getCasesAsString()));

            return Command::FAILURE;
        }

        if (!file_exists($file)) {
            $io->error('File not found: ' . $file);

            return Command::FAILURE;
        }

        $io->title("Importing '{$file}' with type '{$type->value}'");

        // @todo create the import and output the result to cli

        $io->success('Import finished');

        return Command::SUCCESS;
    }
}
