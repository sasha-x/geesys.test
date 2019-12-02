<?php


namespace App\Service;

use Twig\Environment;
use Symfony\Component\HttpKernel\KernelInterface;
use App\Entity\TransferOrder as TransferOrderEntity;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TransferOrder
{
    protected $docType = 'transfer-order';
    protected $printTemplate;
    protected $filePath = "/public/files";

    /** @var string */
    protected $rootDir;
    /** @var Environment */
    protected $twig;
    /** @var PdfGenerator */
    protected $pdfGenerator;
    /** @var LoggerInterface */
    protected $logger;
    /** @var ValidatorInterface */
    protected $validator;

    /** @var TransferOrderEntity */
    protected $order;

    public function __construct(
        KernelInterface $kernel,
        Environment $twig,
        PdfGenerator $pdfGenerator,
        LoggerInterface $logger,
        ValidatorInterface $validator
    ){
        $this->rootDir = $kernel->getProjectDir();
        $this->twig = $twig;
        $this->pdfGenerator = $pdfGenerator;
        $this->logger = $logger;
        $this->validator = $validator;

        $this->printTemplate = $this->docType . '/index.html.twig';
    }

    public function setTransferOrderEntity(TransferOrderEntity $order)
    {
        $this->order = $order;
        return $this;
    }

    public function makePrintView()
    {
        $order = $this->order;
        $docNumber = $order->getNumber();

        if (!$this->validate($order)) {
            $this->logger->error("Try to print invalid order $docNumber");
            return false;
        }

        $htmlContent = $this->twig->render($this->printTemplate, [
            'order' => $order,
            'labelCompany' => $order->getLabelCompany(),
            'request' => $order->getRequest(),
        ]);

        $filePath = $this->getPrintFilePath();
        try {
            $this->pdfGenerator->html2pdf($htmlContent, $filePath);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
            return false;
        }

        $this->logger->debug("Order export to pdf ok: $docNumber");

        return true;
    }

    public function getPrintFilePath()
    {
        $docType = $this->docType;
        $order = $this->order;
        $docNumber = $order->getNumber();
        $created = date("Ymd-Hi", $order->getCreated());
        return $this->getExportPath() . "/$docType-$docNumber-$created.pdf";
    }

    protected function getExportPath()
    {
        return $this->rootDir . $this->filePath;
    }

    protected function validate(TransferOrderEntity $order)
    {
        $errors = $this->validator->validate($order);
        if (count($errors) > 0) {
            /*
             * Uses a __toString method on the $errors variable which is a
             * ConstraintViolationList object. This gives us a nice string
             * for debugging.
             */
            $errorsString = (string)$errors;
            $this->logger->error($errorsString);
            return false;
        }
        return true;
    }

}