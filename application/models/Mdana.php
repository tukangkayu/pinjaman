<?php
Class Mdana extends CI_Model{
	public function ambilPemindahan($where){
		$this->db->order_by('created_at','desc');
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
			$datadokumen = array(
				'id_member'=>$dana->id_member,
				'nama' => $data['filename'],
				'jenis'=>'Invoice pemindahan dana'
			);
			$this->db->insert('dokumen',$datadokumen);
			$insert_id = $this->db->insert_id();
			$sqluser= " update member set saldo = saldo - ".$dana->jumlah." where id_member = ".$dana->id_member;
			$datanotif = array(
				'id_member'=>$dana->id_member,
				'notification'=>'Pemindahan dana sebesar Rp.'.$dana->jumlah.' disetujui oleh admin'
				,'id_dokumen'=>$insert_id,
				'is_read'=>0
			);
			$this->db->insert('notification',$datanotif);
			$this->db->query($sqluser);
		}
		$sql="update pemindahandana set status=".$data['status']." where id = ".$data['id'];
		return $this->db->query($sql);
	}
	public function pengembalian($id){
		$dana = $this->ambilPemindahan(['id_pinjaman'=>$id,'status'=>1]);
		foreach($dana as $d){
			$datanotif = array(
				'id_member'=>$d->id_member,
				'notification'=>'Pemindahan dana sebesar Rp.'.$d->jumlah.' dikembalikan ke saldo karena pinjaman tidak mencapai dana minimal 80% hingga waktu berakhir',
				'is_read'=>0
			);		
			$this->db->insert('notification',$datanotif);
			$sqlmember = "update member set saldo = saldo + ".$d->jumlah." where id_member = ".$d->id_member;
			$this->db->query($sqlmember);
		}
		$this->db->where(['id'=>$id]);
		$this->db->update('pinjaman',['status_pinjaman'=>1]);
	}
	
}