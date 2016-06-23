<?php defined('BASEPATH') OR exit('No direct script access allowed');


use Dompdf\Dompdf;

class PdfGenerator extends Dompdf
{  
	public function generate($view, $filename, $orientation, $data = array())
	{
		$html = get_instance()->load->view($view, $data, TRUE);

		$this->set_paper('a4', $orientation);
		$this->load_html($html);
		$this->render();
		$this->stream($filename);
	}
}

?>
