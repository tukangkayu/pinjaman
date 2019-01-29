<?php
	$kategori = ["Personal","UKM Kecil","Perusahaan Besar"];
	$cara = ["Per Bulan","Akhir Pinjaman"];
?>
<h2>Invoice Pemberian Dana</h2>
<table>
	<tr>
		<td>Judul</td>
		<td>: <?= $pinjam->nama_pinjaman ?></td>
	</tr>
	<tr>
		<td>Kategori Pinjaman</td>
		<td>: <?= $kategori[$pinjam->kategori_pinjaman] ?></td>
	</tr>
	<tr>
		<td>Jumlah Pemberian dana</td>
		<td>: Rp.<?= $dana->jumlah ?></td>
	</tr>
	<tr>
		<td>Tgl Invoice</td>
		<td>: <?= $dana->updated_at ?></td>
	</tr>
	
</table>