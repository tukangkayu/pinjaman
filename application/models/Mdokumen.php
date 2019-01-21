<?php
Class Mdokumen extends CI_Model{
	public function getDokumen($where){
		$this->db->order_by('created_at','desc');
		$data= $this->db->get_where('dokumen',$where)->result();
		return $data;
	}
}