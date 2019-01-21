<?php
Class Mtagihan extends CI_Model{
	public function ambilTagihan($where){
		$this->db->order_by('created_at','desc');
		$data= $this->db->get_where('tagihan',$where)->result();
		return $data;
	}
	public function ambilTagihanBulanan($id){
		$data= $this->db->query("select * from tagihan where id_pinjaman=$id and MONTH(created_at) = MONTH(CURRENT_DATE)")->result();
		return $data;
	}
	public function kirimtagihan($data){
		return $this->db->insert('tagihan',$data);
	}
}