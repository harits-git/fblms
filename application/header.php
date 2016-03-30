Pengumuman :<font color="#2528D1"><strong><blink> Harap mengisi email anda di Menu <a href="index.php?menu=mhs&item=profil">Profil.</a></blink></strong></font>
<br />
<br />

<b><?=$_SESSION["namamhs"].', '.$_SESSION["username"];?></b>, 
<?
    if(isset($_SESSION["username"])){
        echo '<a href="index.php?menu=login&item=logout">[ Keluar ]</a>';
    }

?>
<br />
<br />
<a href="index.php?menu=mhs&item=view">[ Lihat Nilai ]</a>
<a href="index.php?menu=mhs&item=profil">[ Profil ]</a>
<hr />