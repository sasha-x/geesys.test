<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Service\TransferOrder as TransferOrderService;
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
            ->setDescription('Make a new transfer order pdf.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('Make a new transfer order pdf from some sample data');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $order = $this->getOrderSample();

        $transferOrderService = $this->transferOrderService;
        $r = $transferOrderService->setTransferOrderEntity($order)->makePrintView();

        if (!$r) {
            $msg = "Something went wrong. See logs.";
        } else {
            //TODO: return url path instead?
            $filePath = $transferOrderService->getPrintFilePath();
            $msg = "Done: $filePath";
        }
        $output->writeln($msg);
        return (int)$r;
    }

    protected function getOrderSample()
    {
        //make example order object

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
              ->setExecutor($executor);

        $order->setNumber('XXXX');

        return $order;
    }
}