<?php
if (!isset($_GET['target'])){
	$target="user.home";
	} else {
	$target=$_GET['target'];
	}
?>	
<div class="top">
	<div id="logo">
	<span class="image avatar48"><a href="logout.php" class="bottom-tip" data-tips="Sign Out"><img src="images/power.png" alt="" style="margin-right:20px;"/></a></span>
	<?php
	$user=$_SESSION['sesiusername'];	
	if ($_SESSION['sesilevel']=="mahasiswa"){
	$qry=mysql_query("select * from mahasiswa where nim='$user'");
	} else {
	$qry=mysql_query("select * from dosen where id_dosen='$user'");
	}
	$data_user=mysql_fetch_array($qry);
	?>
		<h1 style="margin-left:30px;font-size:20px;" id="title"><?php if ($_SESSION['sesilevel']=="mahasiswa"){ echo $data_user[1]; } else { echo $data_user[2]; } ?></h1>
		<span class="byline"><?php echo $data_user[0]; ?></span>
	</div>
	<nav id="nav">
	<?php
	if ($_SESSION['sesilevel']=="mahasiswa"){
	?>
		<ul>
			<li><a href="index.php?target=user.home" id="top-link" class="<?php if ($target=="user.home"){ echo "active";}?>"><span class="fa fa-home">Homepage</span></a></li>
			<li><a href="index.php?target=mhs.profile" id="about-link" class="<?php if ($target=="mhs.profile" or $target=="mhs.edit.profile"){ echo "active";}?>"><span class="fa fa-user">My Profile</span></a></li>
			<li><a href="index.php?target=mhs.jadwal.kuliah" id="portfolio-link" class="<?php if ($target=="mhs.jadwal.kuliah"){ echo "active";}?>"><span class="fa fa-table">Jadwal Kuliah</span></a></li>
			<?php
				$qry_thn=mysql_query("select * from thn_ajaran order by(id_ta) desc LIMIT 1");
				$data_thn=mysql_fetch_array($qry_thn);
				$qry_krs=mysql_query("select * from krs where nim='$user' and id_ta='$data_thn[0]'");
				$data_krs=mysql_fetch_array($qry_krs);
					$qry_mk=mysql_query("select * from mata_kuliah where kd_mk='$data_krs[2]'");
					$data_mk=mysql_fetch_array($qry_mk);
					if($data_mk[1]=="Skripsi" or $data_mk[1]=="Kerja Praktek" or $data_mk[1]=="Praktek Kerja Lapang"){
			?>
			<li><a href="index.php?target=mhs.kklp.skripsi" id="portfolio-link" class="<?php if ($target=="mhs.kklp.skripsi"){ echo "active";}?>"><span class="fa fa-paperclip">KKLP & Skripsi</span></a></li>
			<?php			
				}
			?>
			<li><a href="index.php?target=mhs.krs" id="portfolio-link" class="<?php if ($target=="mhs.krs" or $target=="mhs.krs.input" or $target=="mhs.krs.save"){ echo "active";}?>"><span class="fa fa-th">Kartu Rencana Studi</span></a></li>
			<li><a href="index.php?target=mhs.history.krs" id="contact-link" class="<?php if ($target=="mhs.history.krs"){ echo "active";}?>"><span class="fa fa-file-text">History KRS</span></a></li>
			<li><a href="index.php?target=mhs.khs" id="contact-link" class="<?php if ($target=="mhs.khs"){ echo "active";}?>"><span class="fa fa-file">Kartu Hasil Studi</span></a></li>
			<li><a href="index.php?target=mhs.transkrip.nilai" id="contact-link" class="<?php if ($target=="mhs.transkrip.nilai"){ echo "active";}?>"><span class="fa fa-book">Transkrip Nilai</span></a></li>
			<!--<li><a href="index.php?target=mhs.social.media" id="contact-link" class="<?php //if ($target=="mhs.social.media"){ echo "active";}?>"><span class="fa fa-facebook-square">Social Media</span></a></li>-->
		</ul>
	<?php
	} else {
	?>	
		<ul>
			<li><a href="index.php?target=user.home" id="top-link" class="<?php if ($target=="user.home"){ echo "active";}?>"><span class="fa fa-home">Homepage</span></a></li>
			<li><a href="index.php?target=dsn.profile" id="about-link" class="<?php if ($target=="dsn.profile" or $target=="dsn.edit.profile"){ echo "active";}?>"><span class="fa fa-user">My Profile</span></a></li>
			<li><a href="index.php?target=dsn.jadwal.kuliah" id="portfolio-link" class="<?php if ($target=="dsn.jadwal.kuliah"){ echo "active";}?>"><span class="fa fa-table">Jadwal Mengajar</span></a></li>
			<li><a href="index.php?target=dsn.input.nilai" id="contact-link" class="<?php if ($target=="dsn.input.nilai"){ echo "active";}?>"><span class="fa fa-book">Input Nilai Mahasiswa</span></a></li>
			<?php
				$qry_pa=mysql_query("select * from pembimbing where id_dosen='$user'");
				$jum_pa=mysql_num_rows($qry_pa);
				if ($jum_pa>0) {
			?>
			<li><a href="index.php?target=dsn.bimbingan" id="contact-link" class="<?php if ($target=="dsn.bimbingan" or $target=="dsn.look.data.bimbingan"){ echo "active";}?>"><span class="fa fa-group">Bimbingan Mahasiswa</span></a></li>
			<?php
				}
			?>
			<?php
				$qry_pem_kklp=mysql_query("select * from pembimbing_kklp where id_dosen='$user'");
				$jum_pem_kklp=mysql_num_rows($qry_pem_kklp);
				if ($jum_pem_kklp>0) {
			?>
			<li><a href="index.php?target=dsn.bimbingan.kklp" id="contact-link" class="<?php if ($target=="dsn.bimbingan.kklp" or $target=="dsn.look.data.kklp"){ echo "active";}?>"><span class="fa fa-group">Bimbingan KKLP</span></a></li>
			<?php
				}
			?>
			
			<?php
				$qry_pem_skripsi=mysql_query("select * from pembimbing_skripsi where dosen1='$user' or dosen2='$user'");
				$jum_pem_skripsi=mysql_num_rows($qry_pem_skripsi);
				if ($jum_pem_skripsi>0) {
			?>
			<li><a href="index.php?target=dsn.bimbingan.skripsi" id="contact-link" class="<?php if ($target=="dsn.bimbingan.skripsi" or $target=="dsn.look.data.skripsi"){ echo "active";}?>"><span class="fa fa-group">Bimbingan Skripsi</span></a></li>
			<?php
				}
			?>
			
		</ul>
	<?php
	}
	?>
	</nav>
</div>
<!--
<div class="bottom">
	<ul class="icons">
		<li><a href="logout.php" style="width:200px;">Keluar / Sign Out</a></li>
	</ul>
</div>
-->