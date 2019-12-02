<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Service\TransferOrderService;

class MakeTransferOrderCommand extends Command
{
    protected static $defaultName = 'app:mk-transfer-order';

    protected $transferOrderService;

    public function __construct(TransferOrderService $transferOrderService)
    {
        $this->transferOrderService = $transferOrderService;

        parent::__construct();
    }

    protected function configure()
    {
        $this
        // the short description shown while running "php bin/console list"
        ->setDescription('Make a new transfer order.')

        // the full command description shown when running the command with
        // the "--help" option
        ->setHelp('Make a new transfer order from input data with default template')
    ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filePath = $this->transferOrderService->makePrintView();
        $output->writeln("Done: $filePath");
        return 0;
    }
}