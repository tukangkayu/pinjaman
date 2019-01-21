<?php
Class Mdana extends CI_Model{
	public function ambilPemindahan($where){
		$data= $this->db->get_where('pemindahandana',$where)->result();
		return $data;
	}
	public function beriDana($data){
		$save = array(
			'id_member'=>$_SESSION['id_member'],
			'id_pinjaman'=>$data['id'],
			'jumlah'=>$data['jumlahuang'],
		);
		$this->db->insert('pemindahandana',$save);
	}
	public function verifikasiDana($data){
		$dana = $this->ambilPemindahan(['id'=>$data['id']])[0];
		if($data['status']==1){
			$sqluser= " update member set saldo = saldo - ".$dana->jumlah." where id_member = ".$dana->id_member;
			$datanotif = array(
				'id_member'=>$dana->id_member,
				'notification'=>'Pemindahan dana sebesar Rp.'.$dana->jumlah.' disetujui oleh admin',
				'is_read'=>0
			);
			$this->db->insert('notification',$datanotif);
			$this->db->query($sqluser);
		}
		$sql="update pemindahandana set status=".$data['status']." where id = ".$data['id'];
		return $this->db->query($sql);
	}
	
}