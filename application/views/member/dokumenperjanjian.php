<?php
	$kategori = ["Personal","UKM Kecil","Perusahaan Besar"];
	$cara = ["Per Bulan","Akhir Pinjaman"];
?>
<h2>Dokumen Perjanjian</h2>
<table>
	<tr>
		<td>Judul</td>
		<td>: <?= $judul ?></td>
	</tr>
	<tr>
		<td>Kategori Pinjaman</td>
		<td>: <?= $kategori[$jenis] ?></td>
	</tr>
	<tr>
		<td>Jumlah Pinjaman</td>
		<td>: Rp.<?= $jumlah ?></td>
	</tr>
	<tr>
		<td>Lama Pinjaman</td>
		<td>: <?= $lamapinjaman ?> Bulan</td>
	</tr>
	<tr>
		<td>Bunga Efektif</td>
		<td>: <?= $bunga ?>%</td>
	</tr>
	<tr>
		<td>Cara Pembayaran</td>
		<td>: <?= $cara[$carabayar] ?></td>
	</tr>
	<tr>
		<td>No NPWP</td>
		<td>: <?= $npwp ?></td>
	</tr>
</table>