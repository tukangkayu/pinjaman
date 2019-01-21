<?php
Class Mnotification extends CI_Model{
	public function userNotification($where){
		$this->db->order_by('tgl_dibuat','desc');
		$data= $this->db->get_where('notification',$where)->result();
		return $data;
	}
	public function updateNotification($id){
		$sql="update notification set is_read=1 where id_member = $id";
		return $this->db->query($sql);
	}
}