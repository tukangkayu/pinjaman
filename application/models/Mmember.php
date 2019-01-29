<?php
Class Mmember extends CI_Model{
	public function ambilSemuaMember($where=[]){
		$this->db->select("*");
		$this->db->from("member");
		$this->db->where($where);
		$this->db->order_by('created_at','desc');
		return $this->db->get()->result();
	}
	public function updateProfile($data){
		//foto ktp
		$target_dir_ktp = "uploads/ktp/";
		$nama_file_ktp=$data['ktplama'];
		if(file_exists("uploads/ktp/".$ktplama)){
			unlink("uploads/ktp/".$ktplama);
		}
		if($_FILES['fotoktp']['error'] != 4){
			$target_file_ktp = $target_dir_ktp.basename($_FILES["fotoktp"]["name"]);
			$fileTipe_ktp = pathinfo($target_file_ktp,PATHINFO_EXTENSION);
			$nama_file_ktp=$data['nama']."_ktp_".Date("dmYis").".".$fileTipe_ktp;
			$nama_simpan_ktp= $target_dir_ktp.$nama_file_ktp;
			move_uploaded_file($_FILES["fotoktp"]["tmp_name"], $nama_simpan_ktp);
		}
		//foto profile

		$nama_file_profile = $data['profilelama'];
		if($_FILES['fotoprofile']['error'] != 4){
			if(file_exists("uploads/profile/".$nama_file_profile)){
				unlink("uploads/profile/".$nama_file_profile);
			}
			$target_dir_profile = "uploads/profile/";
			$target_file_profile = $target_dir_profile.basename($_FILES["fotoprofile"]["name"]);
			$fileTipe_profile = pathinfo($target_file_profile,PATHINFO_EXTENSION);
			$nama_file_profile=$data['nama']."_profile_".Date("dmYis").".".$fileTipe_profile;
			$nama_simpan_profile = $target_dir_profile.$nama_file_profile;
			move_uploaded_file($_FILES["fotoprofile"]["tmp_name"], $nama_simpan_profile);
		}
		$save = array(
			'nama_member'=>$data['nama'],
			'noktp'=>$data['noktp'],
			'tgllahir'=>$data['tgllahir'],
			'fotoktp'=>$nama_file_ktp,
			'alamat'=>$data['alamat'],
			'provinsi'=>$data['provinsi'],
			'kabupaten'=>$data['kabupaten'],
			'kodepos'=>$data['kodepos'],
			'handphone1'=>$data['hp1'],
			'handphone2'=>$data['hp2'],
			'fotoprofil'=>$nama_file_profile
		);
		$this->db->where("id_member",$_SESSION['id_member']);
		$query = $this->db->update('member',$save);
		return $query;
	}
	public function updateRekening($data){
		$nama_file_tabungan = $data['tabunganlama'];
		if($_FILES['fotobukutabungan']['error'] != 4){
			$target_dir_tabungan = "uploads/tabungan/";
			$target_file_tabungan = $target_dir_tabungan.basename($_FILES["fotobukutabungan"]["name"]);
			$fileTipe_tabungan = pathinfo($target_file_tabungan,PATHINFO_EXTENSION);
			$nama_file_tabungan=$data['nama']."_tabungan_".Date("dmYis").".".$fileTipe_tabungan;
			$nama_simpan_tabungan = $target_dir_tabungan.$nama_file_tabungan;
			move_uploaded_file($_FILES["fotobukutabungan"]["tmp_name"], $nama_simpan_tabungan);
		}
		$save = array(
			'namabank'=>$data['namabank'],
			'norekening'=>$data['norekening'],
			'namarekening'=>$data['namarekening'],
			'fotobukutabungan'=>$nama_file_tabungan
		);
		$this->db->where("id_member",$_SESSION['id_member']);
		$query = $this->db->update('member',$save);
		return $query;
	}
	public function updateEmail($data){
		$save = array(
			'email_member'=>$data['emailbaru']
		);
		$this->db->where("id_member",$_SESSION['id_member']);
		$query = $this->db->update('member',$save);
		return $query;
	}
	public function updatePassword($data){
		$member= $this->ambilSemuaMember(array('id_member'=>$_SESSION['id_member']))[0];
		if($member->password_member!=$data['passwordlama']){
			return 'Password lama salah';
		}else{
			$save = array(
				'password_member'=>$data['passwordbaru']
			);
			$this->db->where("id_member",$_SESSION['id_member']);
			$query = $this->db->update('member',$save);
			return $query?'sukses':'Terjadi kesalahan';		
		}
	}
	public function konfirmasiMember($data){
		if($data['status']==2){
			$sqluser= " update member set alasanditolak='".$data['penolakan']."' where id_member = ".$data['id'];
			$this->db->query($sqluser);
			$datanotif = array(
				'id_member'=>$data['id'],
				'notification'=>'Verifikasi ditolak => '.$data['penolakan'].' .Segera update profile kembali'
			);
			$this->db->insert('notification',$datanotif);
		}else if($data['status']==1){
			$datanotif = array(
				'id_member'=>$data['id'],
				'notification'=>'Profile anda telah diverifikasi member.Sekarang anda dapat mengajukan atau meminjam'
			);
			$this->db->insert('notification',$datanotif);
		}
		$sql="update member set statusverifikasi=".$data['status']." where id_member = ".$data['id'];
		return $this->db->query($sql);
	}
	public function banned($data){
		if($data['statuspengguna']==1){
			$sql="update member set statuspengguna=2,alasanbanned='".$data['alasanbanned']."' where id_member = ".$data['id_member'];		
			$datanotif = array(
				'id_member'=>$data['id_member'],
				'notification'=>'Anda telah dibanned oleh admin =>'.$data['alasanbanned'].' .Segera hubungi kami agar banned dibuka'
			);
			$this->db->insert('notification',$datanotif);	
		}else if($data['statuspengguna']==2){
			$sql="update member set statuspengguna=1,alasanbanned='' where id_member = ".$data['id_member'];	
			$datanotif = array(
				'id_member'=>$data['id_member'],
				'notification'=>'Banned anda telah dibatalkan anda bisa menggunakan kembali'
			);
			$this->db->insert('notification',$datanotif);	
		}
		return $this->db->query($sql);
	}
}
?>
