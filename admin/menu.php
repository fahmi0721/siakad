<?php
	if ($_SESSION["loglevel"]=="admin") {
?>
<ul id="nav" class="fl">
	
	<li class="v-sep"><a href="#" class="round button dark menu-user image-left">Logged in as <strong>admin</strong></a>
		<ul>
			<li><a href="index.php?target=home">Homepage</a></li>
			<li><a href="index.php?target=look.password.admin">Change Password</a></li>
			<li><a href="logout.php">Log out</a></li>
		</ul> 
	</li>
	<li class="v-sep"><a href="#" class="round button dark menu-master image-left">Mastering</a>
		<ul>
			<li><a href="index.php?target=look.dosen">Dosen</a></li>
			<li><a href="index.php?target=look.mhs">Mahasiswa</a></li>
			<li><a href="index.php?target=look.mk">Matakuliah</a></li>
			<li><a href="index.php?target=look.thn.ajaran">Tahun Ajaran</a></li>
			<li><a href="index.php?target=look.kelas">Kelas</a></li>
			<li><a href="index.php?target=look.ruangan">Ruangan</a></li>
			<li><a href="index.php?target=look.info">Informasi</a></li>
		</ul> 
	</li>
	<li class="v-sep"><a href="#" class="round button dark menu-studi image-left">Program Studi</a>
		<ul>
			<li><a href="index.php?target=look.jurusan">Jurusan</a></li>
			<li><a href="index.php?target=look.konsentrasi">Konsentrasi</a></li>
		</ul> 
	</li>
	<li class="v-sep"><a href="index.php?target=look.relasi.mk" class="round button dark menu-rel image-left">Relasi MK</a></li>
	<li><a href="logout.php" class="round button dark menu-logoff image-left">Log out</a></li>
				
</ul> <!-- end nav -->
<?php
	} else if ($_SESSION["loglevel"]=="baak") {
?>
<ul id="nav" class="fl">
	
	<li class="v-sep"><a href="#" class="round button dark menu-user image-left">Logged in as <strong>BAAK</strong></a>
		<ul>
			<li><a href="index.php?target=home">Homepage</a></li>
			<li><a href="index.php?target=look.password.admin">Change Password</a></li>
			<li><a href="logout.php">Log out</a></li>
		</ul> 
	</li>
	<li class="v-sep"><a href="index.php?target=look.pa" class="round button dark menu-pa image-left">Penasehat Akademik</a></li>
	<li class="v-sep"><a href="index.php?target=look.kelas.kuliah" class="round button dark menu-kel image-left">Kelas Kuliah</a></li>
	<li class="v-sep"><a href="index.php?target=look.jadwal.kuliah" class="round button dark menu-jadwal image-left">Jadwal Kuliah</a></li>
	<li class="v-sep"><a href="#" class="round button dark menu-master image-left">KKLP</a>
		<ul>
			<li><a href="index.php?target=look.kklp">Data KKLP</a></li>
			<li><a href="index.php?target=look.pem.kklp">Pembimbing KKLP</a></li>
		</ul> 
	</li>
	<li class="v-sep"><a href="index.php?target=look.skripsi" class="round button dark menu-jadwal image-left">Skripsi</a></li>
	<li><a href="logout.php" class="round button dark menu-logoff image-left">Log out</a></li>
				
</ul> <!-- end nav -->
<?php
} else if ($_SESSION["loglevel"]=="bauk") {
?>
<ul id="nav" class="fl">
	
	<li class="v-sep"><a href="#" class="round button dark menu-user image-left">Logged in as <strong>BAUK</strong></a>
		<ul>
			<li><a href="index.php?target=home">Homepage</a></li>
			<li><a href="index.php?target=look.password.admin">Change Password</a></li>
			<li><a href="logout.php">Log out</a></li>
		</ul> 
	</li>
	<li class="v-sep"><a href="index.php?target=look.verifikasi.bayar" class="round button dark menu-ver image-left">Verifikasi Pembayaran</a></li>
	<li><a href="logout.php" class="round button dark menu-logoff image-left">Log out</a></li>
				
</ul> <!-- end nav -->
<?php
} else if ($_SESSION["loglevel"]=="prodi") {
?>
<ul id="nav" class="fl">
	<?php
		$query_jur=mysql_query("select * from jurusan where kd_jurusan='$_SESSION[logusername]'");
		$data_jur=mysql_fetch_array($query_jur);
	?>
	<li class="v-sep"><a href="#" class="round button dark menu-user image-left">Logged in as <strong>Prodi <?php echo $data_jur[1]; ?></strong></a>
		<ul>
			<li><a href="index.php?target=home">Homepage</a></li>
			<li><a href="index.php?target=look.password.admin">Change Password</a></li>
			<li><a href="logout.php">Log out</a></li>
		</ul> 
	</li>
	<li class="v-sep"><a href="index.php?target=look.prodi.dosen" class="round button dark menu-ver image-left">Dosen</a></li>
	<li class="v-sep"><a href="index.php?target=look.prodi.mhs" class="round button dark menu-ver image-left">Mahasiswa</a></li>
	<li class="v-sep"><a href="index.php?target=look.prodi.mk" class="round button dark menu-ver image-left">Matakuliah</a></li>
	<li class="v-sep"><a href="index.php?target=look.prodi.jadwal.kuliah" class="round button dark menu-ver image-left">Jadwal Perkuliahan</a></li>
	<li class="v-sep"><a href="#" class="round button dark menu-master image-left">Skripsi</a>
		<ul>
			<li><a href="index.php?target=look.prodi.skripsi">Data Skripsi</a></li>
			<li><a href="index.php?target=look.prodi.pembimbing.skripsi">Pembimbing Skripsi</a></li>
		</ul> 
	</li>
	<li><a href="logout.php" class="round button dark menu-logoff image-left">Log out</a></li>
				
</ul> <!-- end nav -->
<?php
} else if ($_SESSION["loglevel"]=="ketua") {
?>
<ul id="nav" class="fl">
	<li class="v-sep"><a href="#" class="round button dark menu-user image-left">Logged in as <strong><?php if ($_SESSION['logusername']=="ketua"){ echo "Ketua"; } else { echo "Wakil Ketua"; } ?></strong></a>
		<ul>
			<li><a href="index.php?target=home">Homepage</a></li>
			<li><a href="index.php?target=look.password.admin">Change Password</a></li>
			<li><a href="logout.php">Log out</a></li>
		</ul> 
	</li>
	<li class="v-sep"><a href="index.php?target=look.prodi.dosen" class="round button dark menu-ver image-left">Dosen</a></li>
	<li class="v-sep"><a href="index.php?target=look.ketua.mhs" class="round button dark menu-ver image-left">Mahasiswa</a></li>
	<li class="v-sep"><a href="index.php?target=look.ketua.mk" class="round button dark menu-ver image-left">Matakuliah</a></li>
	<li class="v-sep"><a href="index.php?target=look.ketua.jadwal.kuliah" class="round button dark menu-ver image-left">Jadwal Perkuliahan</a></li>
	<li><a href="logout.php" class="round button dark menu-logoff image-left">Log out</a></li>
				
</ul> <!-- end nav -->
<?php
}
?>