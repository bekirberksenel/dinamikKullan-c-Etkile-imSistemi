<?php
session_start();

if(!isset($_SESSION['user_session']))
{
	header("Location: index.php");
}

include_once 'dbconfig.php';

$stmt = $db_con->prepare("SELECT * FROM tbl_users WHERE user_id=:uid");
$stmt->execute(array(":uid"=>$_SESSION['user_session']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt2 = $db_con->prepare("SELECT * FROM tbl_attribute WHERE user_id=:uid ORDER BY id DESC");
$stmt2->execute(array(":uid"=>$_SESSION['user_session']));

$stmt3 = $db_con->prepare("SELECT * FROM `tbl_users` WHERE user_id NOT IN (:uid) ORDER BY user_id DESC");
$sonuc = $stmt3->execute(array(":uid"=>$_SESSION['user_session']));

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HW</title>
<link rel="icon" type="image/png" sizes="32x32" href="image/favicon-32x32.png"></link>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"></link>
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet"	media="screen"></link>
<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="js/validation.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css"	media="screen"></link>
</head>

<body>
	<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <span class="navbar-brand"><span class="glyphicon glyphicon-user"></span>&nbsp;<?php echo $row['user_name']; ?></span>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Çıkış</a></li>
          </ul>
        </div>
      </div>
    </nav>
    
    <div class="body-container">
        <div class="container">
            <div class='alert alert-success'>
                <button class='close' data-dismiss='alert'>&times;</button>
                Merhaba <?php echo $row['user_name']; ?>  Sayfanıza hoşgeldiniz
            </div>
            <div class="col-md-3">
                <div class="sidenav">
                	<p class="menuBaslik">Kullanıcı Menüsü</p>
                    <a href="#" data-toggle="modal" data-target="#tableModal">table</a>
                    <a href="#" data-toggle="modal" data-target="#imgModal">img</a>
                    <a href="#" data-toggle="modal" data-target="#pModal">p</a>
                    <a href="#" data-toggle="modal" data-target="#aModal">a</a>
                </div>
                <?php 
            	if($sonuc){
            	    echo "<div class='sidenav'>";
            	    echo "<p class='menuBaslik'>Diğer Kullanıcılar</p>";
            	    while ($rowAttribute2 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                        echo '<a style="padding: 5px 5px; font-size: 15px;" href="profil.php?user_id='.$rowAttribute2["user_id"].'">'.$rowAttribute2["user_name"].'</a>';
            	    }
            	    echo "</div>";    
            	}
            	?>
            </div>
            <div class="col-md-9">
            	<div id="dynamic">
					<?php
					echo "<fieldset>";
					while ($rowAttribute = $stmt2->fetch(PDO::FETCH_ASSOC)) {
					    if($rowAttribute["type"] == "table"){
					        echo "<legend>Table</legend>";
					        echo '<p>' .$rowAttribute["html"] .'</p><a href="#" onclick="sil(\''.$rowAttribute["id"].'\')">Sil</a> <a href="#" id="tableDuzenle" data-id="'.$rowAttribute["id"].'" data-toggle="modal" data-target="#tableModalDuzenle">Düzenle</a></br></br>';
					    }
					    else if($rowAttribute["type"] == "img"){
					        echo "<legend>Image</legend>";
					        echo '<p>' .$rowAttribute["html"] .'</p><a href="#" onclick="sil(\''.$rowAttribute["id"].'\')">Sil</a> <a href="#" id="imgDuzenle" data-id="'.$rowAttribute["id"].'" data-toggle="modal" data-target="#imgModalDuzenle">Düzenle</a></br></br>';
					    }
					    else if($rowAttribute["type"] == "p"){
					        echo "<legend>P</legend>";
					        echo $rowAttribute["html"] .'<a href="#" onclick="sil(\''.$rowAttribute["id"].'\')">Sil</a> <a href="#" id="pDuzenle" data-id="'.$rowAttribute["id"].'" data-toggle="modal" data-target="#pModalDuzenle">Düzenle</a></br></br>';
					    }
					    else{
					        echo "<legend>A</legend>";
					        echo '<p>' .$rowAttribute["html"] .'</p><a href="#" onclick="sil(\''.$rowAttribute["id"].'\')">Sil</a> <a href="#" id="aDuzenle" data-id="'.$rowAttribute["id"].'" data-toggle="modal" data-target="#aModalDuzenle">Düzenle</a></br></br>';
					    }
					}
					echo "</fieldset>";
                    ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal -->
	<div class="modal fade" id="tableModal" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
            	<form method="post" id="table-form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Table Ekle</h4>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" placeholder="Satır sayısı" name="tblSatirSayisi" id="tblSatirSayisi" />
                        </br> 
                        <input type="text" class="form-control" placeholder="Sütun sayısı" name="tblSutunSayisi" id="tblSutunSayisi" /> 
                        </br> 
                        <input type="text" class="form-control" placeholder="Açıklama" name="tblAciklama" id="tblAciklama" /> 
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default" data-dismiss="modal" name="btn-table-ekle" id="table-ekle">Oluştur</button>
                    </div>
                </form>
			</div>
		</div>
	</div>
    
    <!-- Modal -->
	<div class="modal fade" id="imgModal" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
            	<form method="post" id="img-form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Img Ekle</h4>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" placeholder="Resim boyu" name="imgBoy" id="imgBoy" />
                        </br> 
                        <input type="text" class="form-control" placeholder="Resim eni"	name="imgEn" id="imgEn" /> 
                        </br> 
                        <input type="text" class="form-control" placeholder="Resim linki" name="imgLink" id="imgLink" /> 
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default" data-dismiss="modal" name="btn-img-ekle" id="img-ekle">Oluştur</button>
                    </div>
                </form>
			</div>
		</div>
	</div>
    
    <!-- Modal -->
	<div class="modal fade" id="pModal" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
            	<form method="post" id="p-form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">P Ekle</h4>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" placeholder="Paragraf Yazısı" name="pYazi" id="pYazi" />
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default" data-dismiss="modal" name="btn-p-ekle" id="p-ekle">Oluştur</button>
                    </div>
                </form>
			</div>
		</div>
	</div>
    
    <!-- Modal -->
	<div class="modal fade" id="aModal" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
            	<form method="post" id="a-form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">A Ekle</h4>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" placeholder="Link sayfa" name="aLink" id="aLink" />
                        </br> 
                        <input type="text" class="form-control" placeholder="Link yazı"	name="aYazi" id="aYazi" /> 
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default" data-dismiss="modal" name="btn-a-ekle" id="a-ekle">Oluştur</button>
                    </div>
                </form>
			</div>
		</div>
	</div>
	
	<!-- Modal -->
	<div class="modal fade" id="tableModalDuzenle" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
            	<form method="post" id="table-duzenle-form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Table Css Duzenle</h4>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" placeholder="Yazı rengini değiştir(rengi ingilizce yazınız)" name="tableColor" id="tableColor" />
                        </br> 
                        <input type="text" class="form-control" placeholder="Yazı boyutunu değiştir(boyutu sayıyla yazınız)" name="tableFontSize" id="tableFontSize" /> 
                        </br> 
                        <input type="text" class="form-control" placeholder="Yazı şeklini değiştir(italic,bold v.s.)" name="tableFontStyle" id="tableFontStyle" />
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default" data-dismiss="modal" name="btn-table-duzenle" id="table-duzenle">Düzenle</button>
                    </div>
                </form>
			</div>
		</div>
	</div>
	
	<!-- Modal -->
	<div class="modal fade" id="imgModalDuzenle" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
            	<form method="post" id="img-duzenle-form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Img Css Duzenle</h4>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" placeholder="Resim enini değiştir" name="imgEn" id="imgEn" />
                        </br> 
                        <input type="text" class="form-control" placeholder="Resim boyunu değiştir" name="imgBoy" id="imgBoy" /> 
                        </br> 
                        <input type="text" class="form-control" placeholder="Resim çerçevesini değiştir(sayıyla 0-10 arası değer giriniz)" name="imgBorder" id="imgBorder" />
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default" data-dismiss="modal" name="btn-img-duzenle" id="img-duzenle">Düzenle</button>
                    </div>
                </form>
			</div>
		</div>
	</div>
	
	<!-- Modal -->
	<div class="modal fade" id="pModalDuzenle" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
            	<form method="post" id="p-duzenle-form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">P Css Duzenle</h4>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" placeholder="Yazının yerini değiştir(left,right,center)" name="pYer" id="pYer" />
                        </br> 
                        <input type="text" class="form-control" placeholder="Yazıyı büyük veya küçük harfe çevir(lowercase,uppercase)" name="pBuyukKucuk" id="pBuyukKucuk" /> 
                        </br> 
                        <input type="text" class="form-control" placeholder="Yazının altını,üstünü veya ortasını çiz(line-through,underline,overline)" name="pYaziCiz" id="pYaziCiz" />
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default" data-dismiss="modal" name="p-img-duzenle" id="p-duzenle">Düzenle</button>
                    </div>
                </form>
			</div>
		</div>
	</div>
	
	<!-- Modal -->
	<div class="modal fade" id="aModalDuzenle" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
            	<form method="post" id="a-duzenle-form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">P Css Duzenle</h4>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" placeholder="Linkin üstüne geldiğinde mouse harektini değiştir(cell,crosshair,pointer)" name="aCursor" id="aCursor" />
                        </br> 
                        <input type="text" class="form-control" placeholder="Link yazı boyutunu düzenle" name="aBoyut" id="aBoyut" /> 
                        </br> 
                        <input type="text" class="form-control" placeholder="Linke yaklaş - zoom(1 - 10 arası değer giriniz)" name="aZoom" id="aZoom" />
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default" data-dismiss="modal" name="a-img-duzenle" id="a-duzenle">Düzenle</button>
                    </div>
                </form>
			</div>
		</div>
	</div>

<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>