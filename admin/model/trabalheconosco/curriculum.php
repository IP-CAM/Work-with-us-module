<?php
class ModelTrabalheConoscoCurriculum extends Model {
    public function getCurriculum($curriculum_id) {
		$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "curriculum  WHERE curriculum_id = '" . (int)$curriculum_id ."'");
		return $query->rows;
	}
	
	public function getTraView($curriculum_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "curriculum  WHERE curriculum_id = '" . (int)$curriculum_id . "'");
	return  $query->row;
		
}
	

	
	public function deleteCurriculum($curriculum_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "curriculum WHERE curriculum_id = '" . (int)$curriculum_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'curriculum_id=" . (int)$curriculum_id . "'");
		

		$this->cache->delete('curriculum');
	}
    public function getCurriculums($curriculum_id) {
        $curriculum_data = array();
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "curriculum ORDER BY date_added DESC");

		return 	$curriculum_data = $query->rows;

	}

	public function getCurriculumsS($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "curriculum WHERE curriculum_id = '" . (int)$this->db->getLastId() . "'";

			if (isset($data['filter_name']) && !is_null($data['filter_name'])) {
				$sql .= " AND LCASE(name) LIKE '%" . $this->db->escape(strtolower($data['filter_name'])) . "%'";
			}
			if (isset($data['filter_mask']) && !is_null($data['filter_mask'])) {
				$sql .= " AND LCASE(mask) LIKE '%" . $this->db->escape(strtolower($data['filter_mask'])) . "%'";
			}
					
			
			$sort_data = array(
				'name',
				'mask',
				'date_added'
			);

			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY name";
			}

			if (isset($data['order']) && ($data['order'] == 'DESC')) {
				$sql .= " DESC";
			} else {
				$sql .= " ASC";
			}

			if (isset($data['start']) || isset($data['limit'])) {
				if ($data['start'] < 0) {
					$data['start'] = 0;
				}

				if ($data['limit'] < 1) {
					$data['limit'] = 20;
				}

				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			}

			$query = $this->db->query($sql);

			return $query->rows;
		} else {
			$curriculum_data = $this->cache->get('curriculum.' . $this->config->get('config_language_id'));

			if (!$curriculum_data) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "curriculum WHERE curriculum_id = '" . (int)$curriculum_id . "' ORDER BY name ASC");

				$curriculum_data = $query->rows;

				$this->cache->set('curriculum.' . $this->config->get('config_language_id'), $trabalheconosco_data);
			}

			return $curriculum_data;
		}
	}

	
	public function getTotalCurriculums($data = array()) {
		$sql = "SELECT COUNT(DISTINCT curriculum_id) AS total FROM " . DB_PREFIX . "curriculum  WHERE curriculum_id = '" . (int)$this->db->getLastId() . "'";
 
		if (isset($data['filter_name']) && !is_null($data['filter_name'])) {
			$sql .= " AND LCASE(name) LIKE '%" . $this->db->escape(strtolower($data['filter_name'])) . "%'";
		}
		
		

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	
}
?>
