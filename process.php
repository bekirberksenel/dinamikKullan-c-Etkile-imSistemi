<?php
	session_start();
	require_once 'dbconfig.php';

	if(isset($_POST['btn-login']))
	{
		$user_email = trim($_POST['user_email']);
		$user_password = trim($_POST['password']);
		try
		{	
			$stmt = $db_con->prepare("SELECT * FROM tbl_users WHERE user_email=:email");
			$stmt->execute(array(":email"=>$user_email));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();
			
			if($row['user_password']==$user_password){
				echo "ok";
				$_SESSION['user_session'] = $row['user_id'];
			}
			else{
				echo "Email veya şifre doğru değil"; 
			}
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	
	if(isset($_POST['btn-register']))
	{
	    $user_email = trim($_POST['user_email']);
	    $user_password = trim($_POST['password']);
	    $user_name = trim($_POST['name']);
	    $user_surname = trim($_POST['surname']);
	    
	    try
	    {
	        $stmt = $db_con->prepare("INSERT INTO tbl_users (user_name,user_surname,user_email,user_password) VALUES (:name,:surname,:email,:password)");
	        $sonuc = $stmt->execute(array("name"=>$user_name,"surname"=>$user_surname,":email"=>$user_email,"password"=>$user_password));
	        
	        if($sonuc){
	            echo "ok";
	        }
	        else{
	            echo "Aynı email adresi ile kayıt olamazsınız"; 
	        }
	    }
	    catch(PDOException $e){
	        echo $e->getMessage();
	    }
	}
	
	if(isset($_POST['btn-table-ekle']))
	{
	    $tblSatirSayisi = trim($_POST['tblSatirSayisi']);
	    $tblSutunSayisi = trim($_POST['tblSutunSayisi']);
	    $tblAciklama = trim($_POST['tblAciklama']);
	    $html = "";
		$type = "table";
		$style = "'width: 300px; height: 80px;'";
		$html .= "<table style=$style>";
		for($i=0;$i<$tblSatirSayisi;$i++){
			$html .= "<tr>";
			for($j=0;$j<$tblSutunSayisi;$j++){
				$html .= "<td style='border: 1px solid;'>" .$tblAciklama ."</td>";
			}
			$html .= "</tr>";
		}
		$html .= "</table>";
	    
	    try
	    {
	        $stmt = $db_con->prepare("INSERT INTO tbl_attribute (user_id,type,html,style) VALUES (:user_id,:type,:html,:style)");
	        $sonuc = $stmt->execute(array("user_id"=>$_SESSION['user_session'],"type"=>$type,"html"=>$html,"style"=>$style));
	        
	        if($sonuc){
	            echo $html;
	        }
	        else{
	            echo "0"; 
	        }
	    }
	    catch(PDOException $e){
	        echo $e->getMessage();
	    }
	}
	
	if(isset($_POST['btn-table-duzenle']))
	{
	    $tableColor = trim($_POST['tableColor']);
	    $tableFontSize = trim($_POST['tableFontSize']);
	    $tableFontStyle = trim($_POST['tableFontStyle']);
	    $id = trim($_POST['id']);
	    
	    $stmt = $db_con->prepare("SELECT * FROM tbl_attribute WHERE id=:id");
	    $stmt->execute(array(":id"=>$id));
	    $row = $stmt->fetch(PDO::FETCH_ASSOC);
	    
	    $html = $row["html"];
	    $style = $row["style"];
	    $newStyle = "'width: 300px; height: 80px; color: ".$tableColor."; font-size: ".$tableFontSize."px; font-style: ".$tableFontStyle."'";
	    $html = str_replace($style,$newStyle,$html);
	    
	    try
	    {
	        $stmt = $db_con->prepare("UPDATE tbl_attribute SET html =:html, style=:style WHERE id=:id");
	        $sonuc = $stmt->execute(array("html"=>$html,"style"=>$newStyle,"id"=>$id));
	        
	        if($sonuc){
	            echo $html;
	        }
	        else{
	            echo "0";
	        }
	    }
	    catch(PDOException $e){
	        echo $e->getMessage();
	    }
	}
	
	if(isset($_POST['btn-img-ekle']))
	{
	    $imgBoy = trim($_POST['imgBoy']);
	    $imgEn = trim($_POST['imgEn']);
	    $imgLink = trim($_POST['imgLink']);
		
	    $html = "";
		$type = "img";
		$style = "'width: ".$imgEn."px; height: ".$imgBoy."px;'";
		$html .= "<img src=".$imgLink." style=$style />";
	    
	    try
	    {
	        $stmt = $db_con->prepare("INSERT INTO tbl_attribute (user_id,type,html,style) VALUES (:user_id,:type,:html,:style)");
	        $sonuc = $stmt->execute(array("user_id"=>$_SESSION['user_session'],"type"=>$type,"html"=>$html,"style"=>$style));
	        
	        if($sonuc){
	            echo "ok";
	        }
	        else{
	            echo "Img veri tabanına eklenemedi"; 
	        }
	    }
	    catch(PDOException $e){
	        echo $e->getMessage();
	    }
	}
	
	if(isset($_POST['btn-img-duzenle']))
	{
	    $imgEn = trim($_POST['imgEn']);
	    $imgBoy = trim($_POST['imgBoy']);
	    $imgBorder = trim($_POST['imgBorder']);
	    $id = trim($_POST['id']);
	    
	    $stmt = $db_con->prepare("SELECT * FROM tbl_attribute WHERE id=:id");
	    $stmt->execute(array(":id"=>$id));
	    $row = $stmt->fetch(PDO::FETCH_ASSOC);
	    
	    $html = $row["html"];
	    $style = $row["style"];
	    $newStyle = "'width: ".$imgEn."; height: ".$imgBoy."px; border: ".$imgBorder."px solid'";
	    $html = str_replace($style,$newStyle,$html);
	    
	    try
	    {
	        $stmt = $db_con->prepare("UPDATE tbl_attribute SET html =:html, style=:style WHERE id=:id");
	        $sonuc = $stmt->execute(array("html"=>$html,"style"=>$newStyle,"id"=>$id));
	        
	        if($sonuc){
	            echo $html;
	        }
	        else{
	            echo "0";
	        }
	    }
	    catch(PDOException $e){
	        echo $e->getMessage();
	    }
	}
	
	if(isset($_POST['btn-p-ekle']))
	{
	    $pYazi = trim($_POST['pYazi']);
		
	    $html = "";
		$type = "p";
		$style = "'width:100%;'";
		$html .= "<p style=$style>" .$pYazi." </p>";
	    
	    try
	    {
	        $stmt = $db_con->prepare("INSERT INTO tbl_attribute (user_id,type,html,style) VALUES (:user_id,:type,:html,:style)");
	        $sonuc = $stmt->execute(array("user_id"=>$_SESSION['user_session'],"type"=>$type,"html"=>$html,"style"=>$style));
	        
	        if($sonuc){
	            echo "ok";
	        }
	        else{
	            echo "P veri tabanına eklenemedi"; 
	        }
	    }
	    catch(PDOException $e){
	        echo $e->getMessage();
	    }
	}
	
	if(isset($_POST['btn-p-duzenle']))
	{
	    $pYer = trim($_POST['pYer']);
	    $pBuyukKucuk = trim($_POST['pBuyukKucuk']);
	    $pYaziCiz = trim($_POST['pYaziCiz']);
	    $id = trim($_POST['id']);
	    
	    $stmt = $db_con->prepare("SELECT * FROM tbl_attribute WHERE id=:id");
	    $stmt->execute(array(":id"=>$id));
	    $row = $stmt->fetch(PDO::FETCH_ASSOC);
	    
	    $html = $row["html"];
	    $style = $row["style"];
	    $newStyle = "'text-align: ".$pYer."; text-transform: ".$pBuyukKucuk."; text-decoration: ".$pYaziCiz."'";
	    $html = str_replace($style,$newStyle,$html);
	    
	    try
	    {
	        $stmt = $db_con->prepare("UPDATE tbl_attribute SET html =:html, style=:style WHERE id=:id");
	        $sonuc = $stmt->execute(array("html"=>$html,"style"=>$newStyle,"id"=>$id));
	        
	        if($sonuc){
	            echo $html;
	        }
	        else{
	            echo "0";
	        }
	    }
	    catch(PDOException $e){
	        echo $e->getMessage();
	    }
	}
	
	if(isset($_POST['btn-a-ekle']))
	{
	    $aLink = trim($_POST['aLink']);
	    $aYazi = trim($_POST['aYazi']);
		
	    $html = "";
		$type = "a";
		$style = "'width:100%;'";
		$html .= "<a href=".$aLink." style=$style>" .$aYazi. "</a>";
	    
	    try
	    {
	        $stmt = $db_con->prepare("INSERT INTO tbl_attribute (user_id,type,html,style) VALUES (:user_id,:type,:html,:style)");
	        $sonuc = $stmt->execute(array("user_id"=>$_SESSION['user_session'],"type"=>$type,"html"=>$html,"style"=>$style));
	        
	        if($sonuc){
	            echo "ok";
	        }
	        else{
	            echo "A veri tabanına eklenemedi"; 
	        }
	    }
	    catch(PDOException $e){
	        echo $e->getMessage();
	    }
	}
	
	if(isset($_POST['btn-a-duzenle']))
	{
	    $aCursor = trim($_POST['aCursor']);
	    $aBoyut = trim($_POST['aBoyut']);
	    $aZoom = trim($_POST['aZoom']);
	    $id = trim($_POST['id']);
	    
	    $stmt = $db_con->prepare("SELECT * FROM tbl_attribute WHERE id=:id");
	    $stmt->execute(array(":id"=>$id));
	    $row = $stmt->fetch(PDO::FETCH_ASSOC);
	    
	    $html = $row["html"];
	    $style = $row["style"];
	    $newStyle = "'cursor: ".$aCursor."; font-size: ".$aBoyut."; zoom: ".$aZoom."'";
	    $html = str_replace($style,$newStyle,$html);
	    
	    try
	    {
	        $stmt = $db_con->prepare("UPDATE tbl_attribute SET html =:html, style=:style WHERE id=:id");
	        $sonuc = $stmt->execute(array("html"=>$html,"style"=>$newStyle,"id"=>$id));
	        
	        if($sonuc){
	            echo $html;
	        }
	        else{
	            echo "0";
	        }
	    }
	    catch(PDOException $e){
	        echo $e->getMessage();
	    }
	}
	
	if(isset($_POST['dynamic'])){
	    
	    try
	    {
    	    $stmt = $db_con->prepare("SELECT * FROM tbl_attribute WHERE user_id=:uid ORDER BY id DESC");
    	    $sonuc = $stmt->execute(array(":uid"=>$_SESSION['user_session']));
    	    if($sonuc){
        	    echo "<fieldset>";
        	    while ($rowAttribute = $stmt->fetch(PDO::FETCH_ASSOC)) {
        	        if($rowAttribute["type"] == "table"){
        	            echo "<legend>Table</legend>";
        	            echo '<p>' .$rowAttribute["html"] .'</p><a href="#" onclick="sil(\''.$rowAttribute["id"].'\')">Sil</a> <a href="#" id="tableDuzenle" data-id="'.$rowAttribute["id"].'" data-toggle="modal" data-target="#tableModalDuzenle">Düzenle</a></br></br>';
        	        }
        	        else if($rowAttribute["type"] == "img"){
        	            echo "<legend>Images</legend>";
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
    	    }
    	    else{
    	        echo "0"; 
    	    }
	    }
	    catch(PDOException $e){
	        echo $e->getMessage();
	    }
	}
	
	if(isset($_POST['sil'])){
	    
	    $id = trim($_POST['id']);
	    try
	    {
    	    $stmt = $db_con->prepare("DELETE FROM tbl_attribute WHERE id=:uid");
    	    $sonuc = $stmt->execute(array(":uid"=>$id));
    	    if($sonuc){
    	        echo "ok";
    	    }
    	    else{
    	        echo "0";
    	    }
	    }
	    catch(PDOException $e){
	        echo $e->getMessage();
	    }
	}

?>