<?php
Class Madmin extends CI_Model{
	public function ambilAdmin($email){
		$admin = $this->db->query('select * from admin where email_admin = "'.$email.'"')->row();
		return $admin;
	}
	public function kirimtagihan($data){
		$insert= $this->db->insert('notification',$data);
		return $insert;
	}
	public function kirimdenda($id,$denda){
		$this->db->where(['id'=>$id]);
		return $this->db->update('tagihan',['denda'=>$denda]);
	}
	public function setstart($id){
		$pinjam = $this->mpinjaman->ambilPinjaman(['id'=>$id])[0];
		for($i=1;$i<=$pinjam->lama_pinjaman;$i++){
			$bunga = $pinjam->bunga_efektif/12;
			if($pinjam->cara_pembayaran==0){
				$tagihan = ($bunga/100)*($pinjam->jumlah_pinjaman);
				$tagihan += ($pinjam->jumlah_pinjaman/$pinjam->lama_pinjaman);
			}else{

				$tagihan = ($bunga/100)*$pinjam->jumlah_pinjaman;
				if($pinjam->lama_pinjaman==$i){
					$tagihan = $tagihan + $pinjam->jumlah_pinjaman;
				}				
			}

			$data=array(
	            'id_member'=>$pinjam->id_member,
	            'id_pinjaman'=>$pinjam->id,
	            'angsuranke'=>$i,
	            'totaltagihan'=>$tagihan,
	            'tgltagihan'=>Date("Y-m-d",strtotime("+$i month"))
	        );
	        // print_r($data);
	        // echo "<br>"
			$this->db->insert('tagihan',$data);
		}
		$save=array(
			'start_at'=>Date('Y-m-d')
		);
		$this->db->where(["id"=>$id]);
		$query = $this->db->update('pinjaman',$save);
	}
}
?>
