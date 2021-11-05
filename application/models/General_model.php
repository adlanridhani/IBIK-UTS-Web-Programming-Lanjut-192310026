<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class General_model extends CI_Model{

	public function countData($tablename,$data,$groupBy=null) {
		$this->db->select("count(*) as Total");
		$this->db->from($tablename);
		$this->db->where($data);		
		if(!empty($groupBy)){
			 $this->db->group_by($groupBy); 
		}
		$query = $this->db->get();
		return $query;
	}
	

	public function fetchData($tablename,$data,$idsort="", $sort="", $limit=null,$groupBy=null) {
		$this->db->from($tablename);
		$this->db->where($data);
		if(!empty($groupBy)){
			 $this->db->group_by($groupBy); 
		}
		$this->db->order_by($idsort,$sort);
		if(!empty($limit)){
			$explode = explode("#", $limit);
			if(!empty($explode)){
				$start = $explode[0];
				$limit = $explode[1];
				$this->db->limit($limit,$start);				
			}else{
				$this->db->limit($limit);
			}
		}
		$query = $this->db->get();
		return $query;
	}

	public function insertData($tablename,$data){
		try {
			$this->db->insert($tablename,$data);
			return true;
		} catch (Exception $e) {
			return $e."\n".$this->db->_error_message();;
		}
	}

	public function updateData($tablename,$data,$where){
		try {
			$this->db->where($where);
			$this->db->update($tablename, $data);
			return true;
		} catch (Exception $e) {
			return $e."\n".$this->db->_error_message();
		}
	}

	public function deleteData($tablename,$where){
        try {
            $this->db->where($where);
            $this->db->delete($tablename);
            return true;
        } catch (Exception $e) {
            return $e."\n".$this->db->_error_message();;
        }
    }

}