<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Service\TransferOrderService;
use App\Entity\LabelCompany;
use App\Entity\TransferOrder;
use App\Entity\TransferRequest;
use App\Entity\LegalCompany;

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
            ->setHelp('Make a new transfer order from input data with default template');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $order = $this->getOrderSample();


        $filePath = $this->transferOrderService->makePrintView($order);
        $output->writeln("Done: $filePath");
        return 0;
    }

    protected function getOrderSample()
    {
        //make example data objects
        $labelCompany = (new LabelCompany)->setLabel('Geesys DTS');

        $request = (new TransferRequest)->setNumber('YYYY');

        $customer = new LegalCompany();
        $customer->setMainInfo(
            'ООО «Сила»', '77777777', '777777777', '105111', 'Москва, Рублевское шоссе,  д.32,к.2, оф.777'
        );

        $executor = new LegalCompany();
        $executor->setMainInfo(
            'ООО «Джи Системс»',
            '77777777',
            '777777777',
            '143355',
            'Московская область, Балашихинский район, мкр. Янтарный, ул. Кольцевая, д.10, к.3, оф.2');

        $agent = clone $executor;

        $order = new TransferOrder();
        $order->setLabelCompany($labelCompany)
              ->setRequest($request)
              ->setAgent($agent)
              ->setCustomer($customer)
              ->setExecutor($executor)
              ->setNumber('XXXX');

        return $order;
    }
}