<?php
Class Msaldo extends CI_Model{
	public function ambilSemuaSaldo($where=[]){
		$this->db->select("saldo.*,member.nama_member,member.namabank,member.namarekening,member.norekening");
		$this->db->from("saldo");
		$this->db->join("member", "member.id_member = saldo.id_member");
		$this->db->where($where);
		return $this->db->get()->result();
	}
	public function ambilPencairan($where){
		$this->db->order_by('created_at','desc');
		$data= $this->db->get_where('pencairandana',$where)->result();

		return $data;
	}
	public function totalTopup($id){
		$sql="select sum(saldo) as saldo from saldo where status=1 and id_member = $id";
		
		return $this->db->query($sql)->row();
	}
	public function ambilSaldo($where){
		$this->db->order_by('created_at','desc');
		$data= $this->db->get_where('saldo',$where)->result();

		return $data;
	}
	public function topup($data){
		$save = array(
			'id_member' => $_SESSION['id_member'],
			'saldo' => $data['jumlah']
		);
		return $this->db->insert('saldo',$save);
	}
	public function updateSaldo($data){
		$saldo = $this->ambilSaldo(array('id_saldo'=>$data['id']))[0];
		if($data['status']==1){
			$sqluser= " update member set saldo = saldo + ".$saldo->saldo." where id_member = ".$saldo->id_member;
			$datanotif = array(
				'id_member'=>$saldo->id_member,
				'notification'=>'Topup sebesar Rp.'.$saldo->saldo.' disetujui oleh admin',
				'is_read'=>0
			);
			$this->db->insert('notification',$datanotif);
			$this->db->query($sqluser);
		}
		$sql="update saldo set status=".$data['status']." where id_saldo = ".$data['id'];
		return $this->db->query($sql);
	}
	public function uploadBukti($data){
		$target_dir = "uploads/bukti/";
		$target_file1 = $target_dir.basename($_FILES["bukti"]["name"]);
		$fileTipe1 = pathinfo($target_file1,PATHINFO_EXTENSION);
		$nama_file1=$_SESSION['nama_member']."_bukti_".Date("dmYis").".".$fileTipe1;
		$nama_simpan1 = $target_dir.$nama_file1;
		move_uploaded_file($_FILES["bukti"]["tmp_name"], $nama_simpan1);
		$sql="update saldo set fotobukti = '".$nama_file1."' where id_saldo = ".$data['id'];
		return $this->db->query($sql);	
	}
	public function pencairan($data){
		$save = array(
			'id_member' => $_SESSION['id_member'],
			'jumlah' => $data['jumlah'],
			'jenis'=>$data['jenis']
		);
		return $this->db->insert('pencairandana',$save);
	}
	public function verifikasiPencairan($data){
		$cair = $this->ambilPencairan(['id'=>$data['id']])[0];
		if($data['status']==1){
			if($data['jenis']==0){
				$sqluser= " update member set saldo = saldo - ".$cair->jumlah." where id_member = ".$cair->id_member;
				$this->db->query($sqluser);				
			}
			$datanotif = array(
				'id_member'=>$cair->id_member,
				'notification'=>'Pencairan dana saldo '.($data['jenis']==0?'':'Pinjaman').' sebesar Rp.'.$cair->jumlah.' disetujui oleh admin',
				'is_read'=>0
			);
			$this->db->insert('notification',$datanotif);
			$savehistory = array(
				'id_member' => $cair->id_member,
				'id_pencairan'=>$cair->id,
				'bunga'=>round($cair->jumlah/0.99*0.01)
			);
			$this->db->insert('historybungapencairan',$savehistory);

		}
		$sql="update pencairandana set status=".$data['status']." where id = ".$data['id'];
		return $this->db->query($sql);
	}
}
?>
