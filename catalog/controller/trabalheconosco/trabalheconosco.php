<?php 
class ControllerTrabalheConoscoTrabalheConosco extends Controller {  

    private $error = array(); 
	    
  	public function index() {
		$this->language->load('trabalheconosco/trabalheconosco');
    	        $this->document->setTitle($this->language->get('heading_title'));  
	 	$this->load->model('trabalheconosco/trabalheconosco');

    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_trabalheconosco_trabalheconosco->addCurriculum($this->request->post);

          		$this->session->data['success'] = $this->language->get('text_success');

	  		$this->redirect(HTTPS_SERVER . 'index.php?route=trabalheconosco/trabalheconosco/success');

    	}
       
		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
		'href'      => $this->url->link('common/home',  'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
		'href'      => $this->url->link('trabalheconosco/trabalheconosco'),      		
      		'separator' => ' :: '
   		);	
                
    	        $this->data['heading_title'] = $this->language->get('heading_title');
                $this->data['text_select'] = $this->language->get('text_select');
	        $this->data['text_none'] = $this->language->get('text_none');
    	        $this->data['text_address'] = $this->language->get('text_address');
    	        $this->data['text_file_extension_allowed'] = $this->language->get('text_file_extension_allowed');
    	        $this->data['text_fax'] = $this->language->get('text_fax');
	        $this->data['text_your_details'] = $this->language->get('text_your_details');

    	        $this->data['entry_name'] = $this->language->get('entry_name');
    	        $this->data['entry_lastname'] = $this->language->get('entry_lastname');
    	        $this->data['entry_email'] = $this->language->get('entry_email');
    	        $this->data['entry_telephone'] = $this->language->get('entry_telephone');
	        $this->data['entry_filename'] = $this->language->get('entry_filename');
    	        $this->data['entry_address_1'] = $this->language->get('entry_address_1');
    	        $this->data['entry_address_2'] = $this->language->get('entry_address_2');
    	        $this->data['entry_postcode'] = $this->language->get('entry_postcode');
    	        $this->data['entry_city'] = $this->language->get('entry_city');
    	        $this->data['entry_country'] = $this->language->get('entry_country');
    	        $this->data['entry_zone'] = $this->language->get('entry_zone');
    	        $this->data['entry_enquiry'] = $this->language->get('entry_enquiry');
		$this->data['entry_captcha'] = $this->language->get('entry_captcha');
		$this->data['button_upload'] = $this->language->get('button_upload');
		$this->data['captcha_curriculum'] = $this->config->get('config_captcha_curriculum');
		$this->data['maintenance_curriculum'] = $this->config->get('config_maintenance_curriculum');

		

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = '';
		}	
		
		
	       if (isset($this->error['telephone'])) {
			$this->data['error_telephone'] = $this->error['telephone'];
		} else {
			$this->data['error_telephone'] = '';
		}
		if (isset($this->error['email'])) {
			$this->data['error_email'] = $this->error['email'];
		} else {
			$this->data['error_email'] = '';
		}
		if (isset($this->error['filename'])) {
			$this->data['error_filename'] = $this->error['filename'];
		} else {
			$this->data['error_filename'] = '';
		}
				
		if (isset($this->error['enquiry'])) {
			$this->data['error_enquiry'] = $this->error['enquiry'];
		} else {
			$this->data['error_enquiry'] = '';
		}
											
  		if (isset($this->error['address_1'])) {
			$this->data['error_address_1'] = $this->error['address_1'];
		} else {
			$this->data['error_address_1'] = '';
		}
		if (isset($this->error['address_2'])) {
			$this->data['error_address_2'] = $this->error['address_2'];
		} else {
			$this->data['error_address_2'] = '';
		}
		   		
		if (isset($this->error['city'])) {
			$this->data['error_city'] = $this->error['city'];
		} else {
			$this->data['error_city'] = '';
		}
		
		if (isset($this->error['postcode'])) {
			$this->data['error_postcode'] = $this->error['postcode'];
		} else {
			$this->data['error_postcode'] = '';
		}

		if (isset($this->error['country'])) {
			$this->data['error_country'] = $this->error['country'];
		} else {
			$this->data['error_country'] = '';
		}

		if (isset($this->error['zone'])) {
			$this->data['error_zone'] = $this->error['zone'];
		} else {
			$this->data['error_zone'] = '';
		}
		
 		if (isset($this->error['captcha'])) {
			$this->data['error_captcha'] = $this->error['captcha'];
		} else {
			$this->data['error_captcha'] = '';
		}	
		
		
		
                $this->data['button_send'] = $this->language->get('button_send');
    	        $this->data['button_continue'] = $this->language->get('button_continue');
    
                
                $this->data['action'] = HTTP_SERVER . 'index.php?route=trabalheconosco/trabalheconosco';
		$this->data['store'] = $this->config->get('config_name');
    	        $this->data['address'] = nl2br($this->config->get('config_address'));
    	        $this->data['telephone'] = $this->config->get('config_telephone');
    	        $this->data['fax'] = $this->config->get('config_fax');
    	
		if (isset($this->request->post['name'])) {
    		$this->data['name'] = $this->request->post['name'];
		} else {
			$this->data['name'] = '';
		}

		
		if (isset($this->request->post['telephone'])) {
    		$this->data['telephone'] = $this->request->post['telephone'];
		} else {
			$this->data['telephone'] = '';
		}
			
		if (isset($this->request->post['email'])) {
    		$this->data['email'] = $this->request->post['email'];
		} else {
			$this->data['email'] = '';
		}
		if (isset($this->request->post['filename'])) {
			$this->data['filename'] = $this->request->post['filename'];
		} else {
			$this->data['filename'] = '';
		}
		if (isset($this->request->post['mask'])) {
			$this->data['mask'] = $this->request->post['mask'];
		} else {
			$this->data['mask'] = '';
		}
		if (isset($this->request->post['enquiry'])) {
			$this->data['enquiry'] = $this->request->post['enquiry'];
		} else {
			$this->data['enquiry'] = '';
		}
			
					
		if (isset($this->request->post['address_1'])) {
    		$this->data['address_1'] = $this->request->post['address_1'];
		} else {
			$this->data['address_1'] = '';
		}

		if (isset($this->request->post['address_2'])) {
    		$this->data['address_2'] = $this->request->post['address_2'];
		} else {
			$this->data['address_2'] = '';
		}

		if (isset($this->request->post['postcode'])) {
    		$this->data['postcode'] = $this->request->post['postcode'];
		} elseif (isset($this->session->data['shipping_postcode'])) {
			$this->data['postcode'] = $this->session->data['shipping_postcode'];		
		} else {
			$this->data['postcode'] = '';
		}
		
		if (isset($this->request->post['city'])) {
    		$this->data['city'] = $this->request->post['city'];
		} else {
			$this->data['city'] = '';
		}

    	        if (isset($this->request->post['country_id'])) {
      		$this->data['country_id'] = $this->request->post['country_id'];
		} elseif (isset($this->session->data['shipping_country_id'])) {
			$this->data['country_id'] = $this->session->data['shipping_country_id'];		
		} else {	
      		$this->data['country_id'] = $this->config->get('config_country_id');
    	        }

    	        if (isset($this->request->post['zone_id'])) {
      		$this->data['zone_id'] = $this->request->post['zone_id']; 	
		} elseif (isset($this->session->data['shipping_zone_id'])) {
			$this->data['zone_id'] = $this->session->data['shipping_zone_id'];			
		} else {
      		$this->data['zone_id'] = '';
    	        }
		
		$this->load->model('localisation/country');
		
    	        $this->data['countries'] = $this->model_localisation_country->getCountries();
		
                if ($this->config->get('config_captcha_curriculum')) {
		if (isset($this->request->post['captcha'])) {
			$this->data['captcha'] = $this->request->post['captcha'];
		} else {
			$this->data['captcha'] = '';
		}
                }
	
            	
		if ($this->config->get('config_maintenance_curriculum')) {
			return $this->forward('trabalheconosco/trabalheconosco/info');
		}
	
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/trabalheconosco/trabalheconosco.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/trabalheconosco/trabalheconosco.tpl';
		} else {
			$this->template = 'default/template/trabalheconosco/trabalheconosco.tpl';
		}
		
		$this->children = array(
			'common/column_right',
			'common/footer',
			'common/column_left',
			'common/header'
		);
		
 		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));		
  	}

  	public function success() {
		$this->language->load('trabalheconosco/trabalheconosco');

		$this->document->seTtitle = $this->language->get('heading_title'); 

      	       $this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
		'href'      => $this->url->link('common/home',  'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
		'href'      => $this->url->link('trabalheconosco/trabalheconosco'),      		
      		'separator' => ' :: '
   		);	
		
    	        $this->data['heading_title'] = $this->language->get('heading_title');
  	        $this->data['text_message'] = $this->language->get('text_message');
                $this->data['button_send'] = $this->language->get('button_send');

    	        $this->data['button_continue'] = $this->language->get('button_continue');

    	        $this->data['continue'] = HTTP_SERVER . 'index.php?route=common/home';

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/success.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/success.tpl';
		} else {
			$this->template = 'default/template/common/success.tpl';
		}
		
		$this->children = array(
			'common/column_left',
			'common/column_right',
			'common/content_top',
			'common/content_bottom',
			'common/footer',
			'common/header'	
		);
				
		$this->response->setOutput($this->render());	
  	}
   public function upload() {
		$this->language->load('trabalheconosco/trabalheconosco');
		
		$json = array();
    			
		if (!isset($json['error'])) {	
			if (!empty($this->request->files['file']['name'])) {
				$filename = basename(html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8'));
				
				if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 128)) {
					$json['error'] = $this->language->get('error_filename');
				}	  	
				
				// Allowed file extension types
				$allowed = array();
				
				$filetypes = explode("\n", $this->config->get('config_file_extension_allowed_curriculum'));
				
				foreach ($filetypes as $filetype) {
					$allowed[] = trim($filetype);
				}
				
				if (!in_array(substr(strrchr($filename, '.'), 1), $allowed)) {
					$json['error'] = $this->language->get('error_filetype');
				}	
				
				// Allowed file mime types		
				$allowed = array();
				
				$filetypes = explode("\n", $this->config->get('config_file_mime_allowed_curriculum'));
				
				foreach ($filetypes as $filetype) {
					$allowed[] = trim($filetype);
				}
								
				if (!in_array($this->request->files['file']['type'], $allowed)) {
					$json['error'] = $this->language->get('error_filetype');
				}
							
				if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {
					$json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);
				}
									
				if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {
					$json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);
				}
			} else {
				$json['error'] = $this->language->get('error_upload');
			}
		}
		
		if (!isset($json['error'])) {
			if (is_uploaded_file($this->request->files['file']['tmp_name']) && file_exists($this->request->files['file']['tmp_name'])) {
				$ext = md5(mt_rand());
				 
				$json['filename'] = $filename . '.' . $ext;
				$json['mask'] = $filename;

				move_uploaded_file($this->request->files['file']['tmp_name'], DIR_DOWNLOAD . $filename . '.' . $ext);
			}
						
			$json['success'] = $this->language->get('text_upload');
		}	
	
		$this->response->setOutput(json_encode($json));
	}
	
	public function captcha() {
		$this->load->library('captcha');
			$fonts = array(DIR_APPLICATION . 'library/verdana.ttf');

		//$aFonts = array('/demo/public_html/system/library/verdana.ttf');
			include_once(DIR_APPLICATION . 'library/captcha.php');

$oVisualCaptcha = new PhpCaptcha($fonts, 120, 18);
			$oVisualCaptcha->SetBackgroundImages('data/image/menu.png.jpg');

$oVisualCaptcha->SetMinFontSize(12);
$oVisualCaptcha->SetMaxFontSize(15);
$oVisualCaptcha->Create();
	
		$captcha->showImage();
	}
	


  	protected function validate() {
    	if ((utf8_strlen($this->request->post['name']) < 1) || (utf8_strlen($this->request->post['name']) > 200)) {
      		$this->error['name'] = $this->language->get('error_name');
    	}

    	
    	if ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 32)) {
      		$this->error['telephone'] = $this->language->get('error_telephone');
    	}

    	if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
      		$this->error['email'] = $this->language->get('error_email');
    	}

    	if (!file_exists(DIR_DOWNLOAD . $this->request->post['filename']) && !is_file(DIR_DOWNLOAD . $this->request->post['filename'])) {
			$this->error['filename'] = $this->language->get('error_exists');
		}
		if ((utf8_strlen($this->request->post['mask']) < 3) || (utf8_strlen($this->request->post['mask']) > 200)) {
			$this->error['mask'] = $this->language->get('error_mask');
		}	
    	if ((strlen(utf8_decode($this->request->post['enquiry'])) < 10) || (strlen(utf8_decode($this->request->post['enquiry'])) > 3000)) {
      		$this->error['enquiry'] = $this->language->get('error_enquiry');
    	}
    			
    	if ((utf8_strlen($this->request->post['address_1']) < 3) || (utf8_strlen($this->request->post['address_1']) > 128)) {
      		$this->error['address_1'] = $this->language->get('error_address_1');
    	}

    	if ((utf8_strlen($this->request->post['city']) < 2) || (utf8_strlen($this->request->post['city']) > 128)) {
      		$this->error['city'] = $this->language->get('error_city');
    	}

		$this->load->model('localisation/country');
		
		$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);
		
		if ($country_info) {
			if ($country_info['postcode_required'] && (utf8_strlen($this->request->post['postcode']) < 2) || (utf8_strlen($this->request->post['postcode']) > 10)) {
				$this->error['postcode'] = $this->language->get('error_postcode');
			}
			
		}

    	if ($this->request->post['country_id'] == '') {
      		$this->error['country'] = $this->language->get('error_country');
    	}
		
    	if (!isset($this->request->post['zone_id']) || $this->request->post['zone_id'] == '') {
      		$this->error['zone'] = $this->language->get('error_zone');
    	}
        if ($this->config->get('config_captcha_curriculum')) {
    	if (!isset($this->session->data['captcha']) || ($this->session->data['captcha'] != $this->request->post['captcha'])) {
      		$this->error['captcha'] = $this->language->get('error_captcha');
    	}
        }
		
		
    	if (!$this->error) {
      		return true;
    	} else {
      		return false;
    	}
  	}
	public function country() {
		$json = array();
		
		$this->load->model('localisation/country');

    	$country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);
		
		if ($country_info) {
			$this->load->model('localisation/zone');

			$json = array(
				'country_id'        => $country_info['country_id'],
				'name'              => $country_info['name'],
				'iso_code_2'        => $country_info['iso_code_2'],
				'iso_code_3'        => $country_info['iso_code_3'],
				'address_format'    => $country_info['address_format'],
				'postcode_required' => $country_info['postcode_required'],
				'zone'              => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),
				'status'            => $country_info['status']		
			);
		}
		
		$this->response->setOutput(json_encode($json));
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