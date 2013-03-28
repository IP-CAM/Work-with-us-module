<?php
class ControllerTrabalheConoscoDownload extends Controller {
    

	public function download() {
		
           $this->load->model('trabalheconosco/trabalheconosco');
		
		if (isset($this->request->get['curriculum_id'])) {
			$curriculum_id = $this->request->get['trab_conosco_id'];
		} else {
			$curriculum_id= 0;
		}
		
		    $download_info = $this->model_trabalheconosco_trabalheconosco->getCurriculo($curriculum_id);
		
		if ($download_info) {
			$file = DIR_DOWNLOAD . $download_info['filename'];
			$mask = basename($download_info['mask']);

			if (!headers_sent()) {
				if (file_exists($file)) {
					header('Content-Type: application/octet-stream');
					header('Content-Disposition: attachment; filename="' . ($mask ? $mask : basename($file)) . '"');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Pragma: public');
					header('Content-Length: ' . filesize($file));
					
					if (ob_get_level()) ob_end_clean();
					
					readfile($file, 'rb');

					exit;
				} else {
					exit('Error: Could not find file ' . $file . '!');
				}
			} else {
				exit('Error: Headers already sent out!');
			}
		} else {
			//$this->redirect($this->url->link('account/download', '', 'SSL'));
		}
	}
}
?>
