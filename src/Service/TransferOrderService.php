<?php


namespace App\Service;

use Twig\Environment;
use Symfony\Component\HttpKernel\KernelInterface;
use App\Entity\TransferOrder;

class TransferOrderService
{
    protected $docType = 'transfer-order';
    protected $printTemplate = '/index.html.twig';
    protected $filePath = "/public/files";

    protected $rootDir;
    protected $twig;
    protected $pdfGenerator;

    public function __construct(KernelInterface $kernel, Environment $twig, PdfGenerator $pdfGenerator)
    {
        $this->rootDir = $kernel->getProjectDir();
        $this->twig = $twig;
        $this->pdfGenerator = $pdfGenerator;
    }

    public function makePrintView(TransferOrder $order)
    {
        $docType = $this->docType;
        $htmlContent = $this->twig->render($docType . $this->printTemplate, [
            'order' => $order,
            'labelCompany' => $order->getLabelCompany(),
            'request' => $order->getRequest(),
        ]);

        $docNumber = $order->getNumber();

        $filePath = $this->getExportPath() . "/$docType-$docNumber.pdf";

        $this->pdfGenerator->html2pdf($htmlContent, $filePath);

        return $filePath;
    }

    protected function getExportPath()
    {
        return $this->rootDir . $this->filePath;
    }

}