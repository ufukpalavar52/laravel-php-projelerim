<?php
if (isset($_SESSION['authorization'])) {
    if ($_SESSION['authorization'] == 1) {
?>
<div class="container">

        <div class="row">
            <center style="color: red;">
                <h3><strong>Admin Paneli</strong></h3>
            </center>
        </div><br><br/>

        <div class="row">
            <center>
            <div class="col-md-2" >

                <a style="text-decoration: none; color: black;" href="./randevu-talepleri" class="hover">
                    <img src="dist/resimler/iconlar/doctor-icon.png" style="width: 120px; height: 120px;"/><br>
                    <strong>Haftalık Randevular</strong></a>
            </div>

            <div class="col-md-2" >
                    <a style="text-decoration: none; color: black;" href="./gecmis-randevular" class="hover">
                    <img src="dist/resimler/iconlar/history.png" style="width: 120px; height: 120px;"/><br>
                    <strong>Geçmiş Randevular</strong></a>
            </div>

            <div class="col-md-2" >

                    <a style="text-decoration: none; color: black;" href="./tum-randevular" class="hover">
                    <img src="dist/resimler/iconlar/eski.png" style="width: 120px; height: 120px;"/><br>
                    <strong>Tüm Randevular</strong></a>
            </div>
                
            <div class="col-md-2">

                    <a style="text-decoration: none; color: black;" href="./doktorlar" class="hover">
                    <img src="dist/resimler/iconlar/dis-doktor.ico" style="width: 120px; height: 120px;"/><br>
                    <strong>Doktor Yönetim</strong></a>
            </div>
                
            <div class="col-md-2">

                    <a style="text-decoration: none; color: black;" href="./kullanici-ekle" class="hover">
                    <img src="dist/resimler/iconlar/admin.ico" style="width: 120px; height: 120px;"/><br>
                    <strong>Kullanıcı Ekle</strong></a>
            </div>    
            
             <div class="col-md-2" >

                    <a style="text-decoration: none; color: black;" href="./ziyaretci-mesajlari" class="hover">
                    <img src="dist/resimler/iconlar/ziyaretci.png" style="width: 120px; height: 120px;"/><br>
                    <strong>Ziyaretçi Mesajları</strong></a>
             </div>   
            
            </center>
        </div>
</div>
<?php 
    
} else if ($_SESSION['authorization'] == 0) {
?>
<div class="container">

        <div class="row">
            <center style="color: red;">
                <h3><strong>Doktor Paneli</strong></h3>
            </center>
        </div><br><br/>

        <div class="row">
            <center>
            <div class="col-md-4" >

                <a style="text-decoration: none; color: black;" href="./randevu-talepleri" class="hover">
                    <img src="dist/resimler/iconlar/doctor-icon.png" style="width: 120px; height: 120px;"/><br>
                    <strong>Haftalık Randevular</strong></a>
            </div>

            <div class="col-md-4" >
                    <a style="text-decoration: none; color: black;" href="./gecmis-randevular" class="hover">
                    <img src="dist/resimler/iconlar/history.png" style="width: 120px; height: 120px;"/><br>
                    <strong>Geçmiş Randevular</strong></a>
            </div>

            <div class="col-md-4" >

                    <a style="text-decoration: none; color: black;" href="./tum-randevular" class="hover">
                    <img src="dist/resimler/iconlar/eski.png" style="width: 120px; height: 120px;"/><br>
                    <strong>Tüm Randevular</strong></a>
            </div>
            
            </center>
        </div>
    </div>
<?php  
  }
}
?>