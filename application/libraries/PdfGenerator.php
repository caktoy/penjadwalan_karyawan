<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once('dompdf/autoload.inc.php');

use Dompdf\Dompdf;

class PdfGenerator extends Dompdf
{  
	public function generate($view, $filename, $orientation, $size, $data = array())
	{
		$html = get_instance()->load->view($view, $data, TRUE);

		$this->set_paper($size, $orientation);
		$this->load_html($html);
		$this->render();
		$this->stream($filename);
	}
}

?>
