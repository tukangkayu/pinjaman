<?php
Class Mpinjaman extends CI_Model{
	public function ambilSemuaPinjaman($where=[]){
		$this->db->select("saldo.*,member.nama_member,member.namabank,member.namarekening,member.norekening");
		$this->db->from("saldo");
		$this->db->join("member", "member.id_member = saldo.id_member");
		$this->db->where($where);
		return $this->db->get()->result();
	}
	public function ambilPinjaman($where){

		$data= $this->db->get_where('pinjaman',$where)->result();
		return $data;
	}
	public function getKodePinjaman(){
		$data=$this->db->query("select * from pinjaman order by id desc")->row();
		$kode = !empty($data)?"P".(substr($data->kode_pinjaman,1)+1):"P1";
		return $kode;
	}
	public function ajukanPinjaman($data){
		$datadokumen = array(
			'id_member'=>$_SESSION['id_member'],
			'nama' => $data['filename'],
			'jenis'=>'Dokumen perjanjian pinjaman dengan kode = '.$data['kode_pinjaman']
		);
		$this->db->insert('dokumen',$datadokumen);
		$insert_id = $this->db->insert_id();
		$datanotif = array(
			'id_member'=>$_SESSION['id_member'],
			'notification'=>'Dokumen berkas perjanjian untuk pinjaman dengan kode '.$data['kode_pinjaman'],
			'id_dokumen'=>$insert_id,
			'is_read'=>0
		);
		$this->db->insert('notification',$datanotif);
		$target_dir_npwp  = "uploads/npwp/";
		$target_file_npwp = $target_dir_npwp.basename($_FILES["fotonpwp"]["name"]);
		$fileTipe_npwp = pathinfo($target_file_npwp,PATHINFO_EXTENSION);
		$nama_file_npwp=$data['judul']."_npwp_".Date("dmYis").".".$fileTipe_npwp;
		$nama_simpan_npwp= $target_dir_npwp.$nama_file_npwp;
		move_uploaded_file($_FILES["fotonpwp"]["tmp_name"], $nama_simpan_npwp);
		$save = array(
			'id_member' => $_SESSION['id_member'],
			'nama_pinjaman' => $data['judul'],
			'kode_pinjaman'=>$data['kode_pinjaman'],
			'kategori_pinjaman' => $data['jenis'],
			'jumlah_pinjaman' => $data['jumlah'],
			'lama_pinjaman' => $data['lamapinjaman'],
			'bunga_efektif' => $data['bunga'],
			'cara_pembayaran' => $data['carabayar'],
			'id_dokumen' => $insert_id,
			'npwp'=>$data['npwp'],
			'fotonpwp'=>$nama_file_npwp
			);
		$this->db->insert('pinjaman',$save);
		return $this->db->insert_id();
	}
	public function detailPinjaman($where){
		$data= $this->db->get_where('detailpinjaman',$where)->result();
		return $data;
	}
	public function detailUsaha($where){
		$data= $this->db->get_where('detailusaha',$where)->result();
		return $data;	
	}
	public function infoPinjaman($data){
		$nama_file_jaminan='';
		$nama_file_tahun='';
		$nama_file_koran='';
		$nama_file_usaha='';
		$nama_file_dokumenperjanjian='';
		if($_FILES['filejaminan']['error'] != 4){
			$target_dir_jaminan  = "uploads/pinjaman/";
			$target_file_jaminan = $target_dir_jaminan.basename($_FILES["filejaminan"]["name"]);
			$fileTipe_jaminan = pathinfo($target_file_jaminan,PATHINFO_EXTENSION);
			$nama_file_jaminan=$_SESSION['nama_member']."_jaminan_".Date("dmYis").".".$fileTipe_jaminan;
			$nama_simpan_jaminan= $target_dir_jaminan.$nama_file_jaminan;
			move_uploaded_file($_FILES["filejaminan"]["tmp_name"], $nama_simpan_jaminan);
		}
		if($_FILES['filetahun']['error'] != 4){
			$target_dir_tahun  = "uploads/pinjaman/";
			$target_file_tahun = $target_dir_tahun.basename($_FILES["filetahun"]["name"]);
			$fileTipe_tahun = pathinfo($target_file_tahun,PATHINFO_EXTENSION);
			$nama_file_tahun=$_SESSION['nama_member']."_tahun_".Date("dmYis").".".$fileTipe_tahun;
			$nama_simpan_tahun= $target_dir_tahun.$nama_file_tahun;
			move_uploaded_file($_FILES["filetahun"]["tmp_name"], $nama_simpan_tahun);
		}
		if($_FILES['filekoran']['error'] != 4){
			$target_dir_koran  = "uploads/pinjaman/";
			$target_file_koran = $target_dir_koran.basename($_FILES["filekoran"]["name"]);
			$fileTipe_koran = pathinfo($target_file_koran,PATHINFO_EXTENSION);
			$nama_file_koran=$_SESSION['nama_member']."_koran_".Date("dmYis").".".$fileTipe_koran;
			$nama_simpan_koran= $target_dir_koran.$nama_file_koran;
			move_uploaded_file($_FILES["filekoran"]["tmp_name"], $nama_simpan_koran);
		}
		if($_FILES['fileusaha']['error'] != 4){
			$target_dir_usaha  = "uploads/pinjaman/";
			$target_file_usaha = $target_dir_usaha.basename($_FILES["fileusaha"]["name"]);
			$fileTipe_usaha = pathinfo($target_file_usaha,PATHINFO_EXTENSION);
			$nama_file_usaha=$_SESSION['nama_member']."_usaha_".Date("dmYis").".".$fileTipe_usaha;
			$nama_simpan_usaha= $target_dir_usaha.$nama_file_usaha;
			move_uploaded_file($_FILES["fileusaha"]["tmp_name"], $nama_simpan_usaha);
		}
		if($_FILES['dokumenperjanjian']['error'] != 4){
			$target_dir_dokumenperjanjian  = "uploads/pinjaman/";
			$target_file_dokumenperjanjian = $target_dir_dokumenperjanjian.basename($_FILES["dokumenperjanjian"]["name"]);
			$fileTipe_dokumenperjanjian = pathinfo($target_file_dokumenperjanjian,PATHINFO_EXTENSION);
			$nama_file_dokumenperjanjian=$_SESSION['nama_member']."_dokumenperjanjian_".Date("dmYis").".".$fileTipe_dokumenperjanjian;
			$nama_simpan_dokumenperjanjian= $target_dir_dokumenperjanjian.$nama_file_dokumenperjanjian;
			move_uploaded_file($_FILES["dokumenperjanjian"]["tmp_name"], $nama_simpan_dokumenperjanjian);
		}

		$detail = array(
			'id_pinjaman'=>$data['id'],
			'tujuanpinjaman'=>$data['tujuandana'],
			'jumlahpendapatan'=>$data['pendapatan'],
			'jaminan'=>$data['jaminan'],
			'filejaminan'=>$nama_file_jaminan,
			'filelaporankeuangantahun'=>$nama_file_tahun,
			'filerekkoran3'=>$nama_file_koran,
			'fileusaha'=>$nama_file_usaha,
			'filedokumenperjanjian'=>$nama_file_dokumenperjanjian,
		);
		$this->db->insert('detailpinjaman',$detail);
		if($data['kategori_pinjaman']!=0){
			$nama_file_usaha='';
			if($_FILES['fotousaha']['error'] != 4){
				$target_dir_usaha  = "uploads/pinjaman/";
				$target_file_usaha = $target_dir_usaha.basename($_FILES["fotousaha"]["name"]);
				$fileTipe_usaha = pathinfo($target_file_usaha,PATHINFO_EXTENSION);
				$nama_file_usaha=$_SESSION['nama_member']."_fotousaha_".Date("dmYis").".".$fileTipe_usaha;
				$nama_simpan_usaha= $target_dir_usaha.$nama_file_usaha;
				move_uploaded_file($_FILES["fotousaha"]["tmp_name"], $nama_simpan_usaha);
			}
			$usaha = array(
				'id_pinjaman'=>$data['id'],
				'namausaha'=>$data['namausaha'],
				'jenisusaha'=>$data['jenisusaha'],
				'tahunpendirian'=>$data['tahun'],
				'kategoriusaha'=>$data['kategoriusaha'],
				'alamatusaha'=>$data['alamat'],
				'provinsi'=>$data['provinsi'],
				'kabupaten'=>$data['kabupaten'],
				'kodepos'=>$data['kodepos'],
				'telpon1'=>$data['telpon1'],
				'telpon2'=>$data['telpon2'],
				'deskripsi'=>$data['deskripsi'],
				'fotousaha'=>$nama_file_usaha,
				'modalusaha'=>$data['modalusaha'],
				'utangusaha'=>$data['utangusaha'],
			);
			$this->db->insert('detailusaha',$usaha);
		}
	}
	public function verifikasiPinjaman($data){
		if($data['status']==2){
			if($data['alasandetail']!=''){
				$sqldetail= " update detailpinjaman set alasanditolak='".$data['alasandetail']."' where id_pinjaman = ".$data['id'];
				$this->db->query($sqldetail);	
				$datanotif = array(
					'id_member'=>$data['id_member'],
					'notification'=>'Info pinjaman ditolak admin =>'.$data['alasandetail']
				);
				$this->db->insert('notification',$datanotif);			
			}
			if($data['alasanusaha']!=''){
				$sqlusaha= " update detailusaha set alasanditolak='".$data['alasanusaha']."' where id_pinjaman = ".$data['id'];
				$this->db->query($sqlusaha);				
				$datanotif = array(
					'id_member'=>$data['id_member'],
					'notification'=>'Info pinjaman usaha ditolak admin =>'.$data['alasanusaha']
				);
				$this->db->insert('notification',$datanotif);			
			}
			
		}else if($data['status']==1){
			$datanotif = array(
				'id_member'=>$data['id_member'],
				'notification'=>'Pengajuan Pinjaman anda telah diapprove oleh admin'
			);
			$this->db->insert('notification',$datanotif);
		}
		$sql="update pinjaman set status_pengajuan=".$data['status'].",updated_at = CURRENT_TIMESTAMP where id = ".$data['id'];
		return $this->db->query($sql);
	}
}
?>
