<?php

class Pdf {
    protected $dompdf;

    public function __construct() {
        require_once FCPATH . 'vendor/autoload.php'; // autoload dulu

        $this->dompdf = new Dompdf\Dompdf(); // baru bisa dipakai setelah autoload
    }

    public function loadHtml($html) {
        $this->dompdf->loadHtml($html);
    }

    public function setPaper($size, $orientation = 'portrait') {
        $this->dompdf->setPaper($size, $orientation);
    }

    public function render() {
        $this->dompdf->render();
    }

    public function stream($filename = "document.pdf", $options = []) {
        $this->dompdf->stream($filename, $options);
    }
}
