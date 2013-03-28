<?php  
class ControllerModuleTrabalheconosco extends Controller {
    protected function index() {
		$this->language->load('module/trabalheconosco');
		
    	       $this->data['heading_title'] = $this->language->get('heading_title');
    	
		$this->data['text_trabalheconosco'] = $this->language->get('text_trabalheconosco');
    	
		$this->data['trabalheconosco'] = $this->url->link('trabalheconosco/trabalheconosco', '', 'SSL');
    	

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/trabalheconosco.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/trabalheconosco.tpl';
		} else {
			$this->template = 'default/template/module/trabalheconosco.tpl';
		}
		
		$this->render();
	}
}
?>
