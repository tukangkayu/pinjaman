<?php
Class Mtagihan extends CI_Model{
	public function ambilTagihan($where){
		$this->db->order_by('created_at','desc');
		$data= $this->db->get_where('tagihan',$where)->result();
		return $data;
	}
	public function ambilTagihanBulanan($id){
		$data= $this->db->query("select * from tagihan where id_pinjaman=$id and status=0 order by angsuranke asc")->result();
		return $data;
	}
	public function kirimtagihan($data){
		return $this->db->insert('tagihan',$data);
	}
	public function uploadBukti($data){
		$target_dir = "uploads/tagihan/";
		$target_file1 = $target_dir.basename($_FILES["bukti"]["name"]);
		$fileTipe1 = pathinfo($target_file1,PATHINFO_EXTENSION);
		$nama_file1=$_SESSION['nama_member']."_tagihan_".Date("dmYis").".".$fileTipe1;
		$nama_simpan1 = $target_dir.$nama_file1;
		move_uploaded_file($_FILES["bukti"]["tmp_name"], $nama_simpan1);
		$sql="update tagihan set fotobukti = '".$nama_file1."' where id = ".$data['id'];
		return $this->db->query($sql);	
	}
	public function updateTagihan($data){
		$tagihan = $this->ambilTagihan(array('id'=>$data['id']))[0];
		$pinjam = $this->mpinjaman->ambilPinjaman(['id'=>$tagihan->id_pinjaman])[0];
		if($data['status']==1){
			$datanotif = array(
				'id_member'=>$tagihan->id_member,
				'notification'=>'Pembayaran tagihan disetujui oleh admin',
				'is_read'=>0
			);
			$this->db->insert('notification',$datanotif);
			$dana = $this->mdana->ambilPemindahan(['id_pinjaman'=>$tagihan->id_pinjaman,'status'=>1]);
			foreach($dana as $d){
				$persen = $d->jumlah/$pinjam->jumlah_pinjaman;
				$didapat = ($tagihan->totaltagihan + $tagihan->denda) * $persen;
				$didapat=ceil($didapat);
				$bersih = $didapat*(0.99);
				$datanotif = array(
					'id_member'=>$d->id_member,
					'notification'=>'Anda mendapat dana dari angsuran peminjam sebesar '.intval($bersih).' sudah dipotong 1% untuk biaya admin',
					'is_read'=>0
				);
				$this->db->insert('notification',$datanotif);
				$sqlmember = "update member set saldo = saldo + ".intval($bersih)." where id_member = ".$d->id_member;
				$this->db->query($sqlmember);
			}
		}else if($data['status']==2){
			$datanotif = array(
				'id_member'=>$tagihan->id_member,
				'notification'=>'Pembayaran tagihan ditolak admin.Alasan =>'.$data['note'],
				'is_read'=>0
			);
			$this->db->insert('notification',$datanotif);
		}
		$sql="update tagihan set status=".$data['status'].",note='".$data['note']."' where id = ".$data['id'];
		return $this->db->query($sql);
	}
}