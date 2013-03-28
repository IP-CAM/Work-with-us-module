<?php
class ControllerTrabalheConoscoMaintenance extends Controller {
    public function index() {
    
	$this->data['teste'] = $this->config->get('config_maintenance_curriculum');
        if ($teste) {
		    	return $this->forward('trabalheconosco/maintenance/info');
			}
		
		}
	public function info() {
        $this->language->load('trabalheconosco/maintenance');
        
        $this->document->setTitle($this->language->get('heading_title'));
        
        $this->data['heading_title'] = $this->language->get('heading_title');
                
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_maintenance'),
			'href'      => $this->url->link('trabalheconosco/maintenance'),
            'separator' => false
        ); 
        
        $this->data['message'] = $this->language->get('text_message');
      
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/trabalheconosco/maintenance.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/trabalheconosco/maintenance.tpl';
        } else {
            $this->template = 'default/template/trabalheconosco/maintenance.tpl';
        }
		
		$this->children = array(
			'common/footer',
			'common/header'
		);
		
		$this->response->setOutput($this->render());
    }
}
?>