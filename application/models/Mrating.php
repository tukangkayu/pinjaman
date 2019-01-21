<?php
Class Mrating extends CI_Model{
	public function ambilRating($where){
		$data= $this->db->get_where('rating',$where)->result();
		return $data;
	}
	public function totalRating($id){
		$rating = $this->ambilRating(['id_pinjaman'=>$id]);
		$totalrating=0;
		foreach($rating as $r){
			$totalrating += $r->rating;
		}
		return count($rating)>0?($totalrating/count($rating)):0;
	}
	public function beriRating($data){
		$save =array(
			'rating'=>$data['rating'],
			'isi'=>$data['review'],
			'id_pinjaman'=>$data['id'],
			'id_member'=>$_SESSION['id_member']
		);
		return $this->db->insert('rating',$save);
	}
}