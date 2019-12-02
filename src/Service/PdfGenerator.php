<?php

namespace App\Service;

use wkhtmltox\PDF\Converter as PDFConverter;
use wkhtmltox\PDF\Object as PDFObject;

class PdfGenerator
{
    /**
     * @param string $html
     * @param string $outFile
     */
    public function html2pdf($html, $outFile)
    {
        $converter = new PDFConverter([
            "out" => $outFile,
        ]);

        $converter->add(new PDFObject($html));
        $converter->convert();
    }
}