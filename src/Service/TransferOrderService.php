<?php


namespace App\Service;

use Twig\Environment;
use Symfony\Component\HttpKernel\KernelInterface;
use App\Entity\TransferOrder;

class TransferOrderService
{
    protected $printTemplate = 'transfer-order/index.html.twig';
    protected $filePath = "/public/files";

    protected $rootDir;
    protected $twig;

    public function __construct(KernelInterface $kernel, Environment $twig)
    {
        $this->rootDir = $kernel->getProjectDir();
        $this->twig = $twig;
    }

    public function makePrintView(TransferOrder $order)
    {
        $htmlContent = $this->twig->render($this->printTemplate, [
            'order' => $order,
            'labelCompany' => $order->getLabelCompany(),
            'request' => $order->getRequest(),
        ]);

        $filePath = $this->getExportPath();
        $r = file_put_contents($filePath, $htmlContent);
        //
        return $filePath;
    }

    protected function getExportPath()
    {
        return $this->rootDir . $this->filePath . "/123.html";
    }

}