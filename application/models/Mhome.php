<?php
Class Mhome extends CI_Model{
	public function databarang($id){
		if($id==0){
			$query="select barang.*,pasar.namapasar from barang inner join pasar on pasar.id = barang.pasarid";
		}else{
			$query="select barang.*,pasar.namapasar from barang inner join pasar on pasar.id = barang.pasarid where barang.pasarid = $id";
		}
		$barang = $this->db->query($query)->result();
		return $barang;
	}
	//berita
	public function databerita(){
		$berita= $this->db->query("select berita.*,pasar.namapasar from berita inner join pasar on pasar.id = berita.pasarid order by tgldibuat")->result();
		return $berita;
	}
	public function berita($id){
		$berita= $this->db->query("select berita.*,pasar.namapasar from berita inner join pasar on pasar.id = berita.pasarid where berita.id = ".$id)->row();
		return $berita;
	}
	public function profile($id){
		$user = $this->db->query('select * from users where id='.$id)->row();
		return $user;
	}
	public function datapasar(){
		$pasar = $this->db->query('select * from pasar')->result();
		return $pasar;
	}
	public function pasar($id){
		$pasar = $this->db->query('select * from pasar where id='.$id)->row();
		return $pasar;
	}
	public function kios($id){
		$kios = $this->db->query('select * from kios where id='.$id)->row();
		return $kios;
	}
	public function barangkios($id){
		$barang = $this->db->query('select barang.*,barangkios.harga from barangkios inner join barang on barang.id = barangkios.barangid where barangkios.kiosid = '.$id)->result();
		return $barang;
	}
	public function datakios($id){
		$kios = $this->db->query('select * from kios where pasarid = '.$id)->result();
		return $kios;
	}
	public function laporan($data){
		return $this->db->insert('laporan',$data);
	}
}
?>
