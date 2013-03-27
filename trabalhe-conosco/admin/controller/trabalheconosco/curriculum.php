<?php    
class ControllerTrabalheConoscoCurriculum extends Controller {
	private $error = array();
  
  	public function index() {
		$this->language->load('trabalheconosco/curriculum');
		
		$this->document->setTitle($this->language->get('heading_title'));
		 
		$this->load->model('trabalheconosco/curriculum');
		
    	$this->getList();
  	}
  
  	   
  	public function update() {
		$this->language->load('trabalheconosco/setting');

    	$this->document->setTitle($this->language->get('heading_title'));
		
        $this->load->model('trabalheconosco/curriculum');
		$this->load->model('setting/setting');		
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_setting_setting->editSetting('curriculum', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->redirect($this->url->link('trabalheconosco/curriculum', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
    
    	$this->getForm();
  	}   

  	public function delete() {
		$this->language->load('trabalheconosco/curriculum');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('trabalheconosco/curriculum');
			
    	if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $curriculum_id) {
				 $this->model_trabalheconosco_curriculum->deleteCurriculum($curriculum_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->redirect($this->url->link('trabalheconosco/curriculum', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    	}
	
    	$this->getList();
  	}  
    
  	protected function getList() {
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = NULL;
		}
			

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}

		

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
		    'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
		    'href'      => $this->url->link('trabalheconosco/curriculum', 'token=' . $this->session->data['token'] . $url, 'SSL'),       		
      		'separator' => ' :: '
   		);
		$this->data['setting'] = $this->url->link('trabalheconosco/curriculum/update', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['delete'] = $this->url->link('trabalheconosco/curriculum/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		  

		$this->data['curriculums'] = array();

		$data = array(
			'filter_name'	  => $filter_name,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'           => $this->config->get('config_admin_limit')
		);
		
		$curriculum_total = $this->model_trabalheconosco_curriculum->getTotalCurriculums($data);
	
	   if (isset($this->request->get['curriculum_id'])) {
			$curriculum_id = (int)$this->request->get['curriculum_id'];
		} else {
			$curriculum_id = 0;
		}
		
		$results = $this->model_trabalheconosco_curriculum->getCurriculums($curriculum_id);
 
    	foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_view'),
				'href' => $this->url->link('trabalheconosco/curriculum/view', 'token=' . $this->session->data['token'] . '&curriculum_id=' . $result['curriculum_id'] . $url, 'SSL')
			);
						
			$this->data['curriculums'][] = array(
				'curriculum_id' => $result['curriculum_id'],
				'name'       => $result['name'],
				'mask'       => $result['mask'],
				'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'selected'   => isset($this->request->post['selected']) && in_array($result['curriculum_id'], $this->request->post['selected']),
				'href'	    => HTTP_CATALOG . 'index.php?route=trabalheconosco/download/download&curriculum_id=' . $result['curriculum_id']	,				
				'action'     => $action
			);
		}	
	
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_name'] = $this->language->get('column_name');		
		$this->data['column_mask'] = $this->language->get('column_mask');		
		$this->data['column_date_added'] = $this->language->get('column_date_added');		
		$this->data['column_action'] = $this->language->get('column_action');		
		
		$this->data['button_setting'] = $this->language->get('button_setting');	
		$this->data['button_delete'] = $this->language->get('button_delete');
 
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}
        if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$this->data['sort_name'] = $this->url->link('trabalheconosco/curriculum', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$this->data['sort_order'] = $this->url->link('trabalheconosco/curriculum', 'token=' . $this->session->data['token'] . '&sort=date_added' . $url, 'SSL');
		
		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}										
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $curriculum_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('trabalheconosco/curriculum', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();

		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'trabalheconosco/curriculum_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
  
  	protected function getForm() {
    	$this->data['heading_title'] = $this->language->get('heading_title');

    	$this->data['text_no_results'] = $this->language->get('text_no_results');		
		$this->data['text_view'] = $this->language->get('text_view');		
        $this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		
		$this->data['entry_file_extension_allowed_curriculum'] = $this->language->get('entry_file_extension_allowed_curriculum');
		$this->data['entry_file_mime_allowed_curriculum'] = $this->language->get('entry_file_mime_allowed_curriculum');
        $this->data['entry_maintenance_curriculum'] = $this->language->get('entry_maintenance_curriculum');
		$this->data['entry_captcha_curriculum'] = $this->language->get('entry_captcha_curriculum');
		  
    	$this->data['button_save'] = $this->language->get('button_save');
    	$this->data['button_cancel'] = $this->language->get('button_cancel');
		
		$this->data['tab_general'] = $this->language->get('tab_general');
			  
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
 				    
		$url = '';
			
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_curriculum'),
			'href'      => $this->url->link('trabalheconosco/curriculum', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('trabalheconosco/curriculum/updade', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => '::'
   		);
							
		/*if (!isset($this->request->get['curriculum_id'])) {
			$this->data['action'] = $this->url->link('trabalheconosco/curriculum/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('trabalheconosco/curriculum/update', 'token=' . $this->session->data['token'] . '&manufacturer_id=' . $this->request->get['manufacturer_id'] . $url, 'SSL');
		}*/
		$this->data['action'] = $this->url->link('trabalheconosco/curriculum/update', 'token=' . $this->session->data['token'] . '&manufacturer_id=' . $this->request->get['manufacturer_id'] . $url, 'SSL');

		
		$this->data['cancel'] = $this->url->link('trabalheconosco/curriculum', 'token=' . $this->session->data['token'] . $url, 'SSL');

    	 if (isset($this->request->post['config_file_extension_allowed_curriculum'])) {
			$this->data['config_file_extension_allowed_curriculum'] = $this->request->post['config_file_extension_allowed_curriculum'];
		} else {
			$this->data['config_file_extension_allowed_curriculum'] = $this->config->get('config_file_extension_allowed_curriculum');
		}
        
		if (isset($this->request->post['config_file_mime_allowed_curriculum'])) {
			$this->data['config_file_mime_allowed_curriculum'] = $this->request->post['config_file_mime_allowed_curriculum'];
		} else {
			$this->data['config_file_mime_allowed_curriculum'] = $this->config->get('config_file_mime_allowed_curriculum');
		}
                
		if (isset($this->request->post['config_maintenance_curriculum'])) {
			$this->data['config_maintenance_curriculum'] = $this->request->post['config_maintenance_curriculum'];
		} else {
			$this->data['config_maintenance_curriculum'] = $this->config->get('config_maintenance_curriculum');
		}
		if (isset($this->request->post['config_captcha_curriculum'])) {
			$this->data['config_captcha_curriculum'] = $this->request->post['config_captcha_curriculum'];
		} else {
			$this->data['config_captcha_curriculum'] = $this->config->get('config_captcha_curriculum');
		}
		
		$this->template = 'trabalheconosco/curriculum_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}  
	
    public function view() {
		$this->load->model('trabalheconosco/curriculum');

		$this->language->load('trabalheconosco/curriculum');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->data['heading_title'] = $this->language->get('heading_title');

		
		if (isset($this->request->get['curriculum_id'])) {
			$curriculum_id = (int)$this->request->get['curriculum_id'];
		} else {
			$curriculum_id = 0;
		}     
        		
		$curriculum_info  = $this->model_trabalheconosco_curriculum->getTraView($curriculum_id);
		
		if ($curriculum_info) {
			$output  = '<div class="content">' . "\n";
			$output .= '<table class="form">' . "\n";
			$output .= '<tbody>' . "\n";
			$output .= '<tr><td><b>'. $this->language->get('text_name').'</b>' . $curriculum_info['name'] . '</td></tr>' . "\n";
			$output .= '<tr><td><b>'. $this->language->get('text_email').'</b>' . $curriculum_info['email'] . '</td></tr>' . "\n";
			$output .= '<tr><td><b>'. $this->language->get('text_telephone').'</b>' . $curriculum_info['telephone'] . '</td></tr>' . "\n";
			$output .= '<tr><td><b>'. $this->language->get('text_address_1').'</b>' . $curriculum_info['address_1'] . '</td></tr>' . "\n";
			$output .= '<tr><td><b>'. $this->language->get('text_address_2').'</b>' . $curriculum_info['address_2'] . '</td></tr>' . "\n";
			$output .= '<tr><td><b>'. $this->language->get('text_postcode').'</b>' . $curriculum_info['postcode'] . '</td></tr>' . "\n";
			$output .= '<tr><td><b>'. $this->language->get('text_city').'</b>' . $curriculum_info['city'] . '</td></tr>' . "\n";
			$output .= '<tr><td><b>'. $this->language->get('text_filename').'</b><a href=' .HTTP_CATALOG . 'index.php?route=trabalheconosco/download/download&curriculum_id='.$curriculum_info['curriculum_id']. ' target="_blank">' . $curriculum_info['mask'] . '</a></td></tr>' . "\n";
			$output .= '<tr><td><b>'. $this->language->get('text_enquiry').'</b><p>' . html_entity_decode($curriculum_info['enquiry'], ENT_QUOTES, 'UTF-8') .  '</p></td></tr>' . "\n";

			$output .= '</tbody>' ."\n";
			$output .= '  </table>' . "\n";
			$output .= '</div' . "\n";			

			$this->response->setOutput($output);
		}
}		
  	protected function validateForm() {
    	if (!$this->user->hasPermission('modify', 'trabalheconosco/curriculum')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}
         foreach ($this->request->post['trabalheconosco_description'] as $language_id => $value) {
      		if ((strlen(utf8_decode($value['name'])) < 1) || (strlen(utf8_decode($value['name'])) > 255)) {
        		$this->error['name'][$language_id] = $this->language->get('error_name');
      		}
    	}    	
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}    

  	protected function validateDelete() {
    	if (!$this->user->hasPermission('modify', 'trabalheconosco/curriculum')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}

		if (!$this->error) {
	  		return TRUE;
		} else {
	  		return FALSE;
		}
  	}
	
	
}
?>