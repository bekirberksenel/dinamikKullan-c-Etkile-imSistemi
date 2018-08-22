<?php
session_start();

include_once 'dbconfig.php';

$stmt = $db_con->prepare("SELECT * FROM tbl_users WHERE user_id=:uid");
$stmt->execute(array(":uid"=>$_REQUEST['user_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt2 = $db_con->prepare("SELECT * FROM tbl_attribute WHERE user_id=:uid ORDER BY id DESC");
$stmt2->execute(array(":uid"=>$_REQUEST['user_id']));

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
            <li><a href="home.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Kendi Sayfana Geri Dön</a></li>
          </ul>
        </div>
      </div>
    </nav>
    
    <div class="body-container">
        <div class="container">
            <div class='alert alert-success'>
                <button class='close' data-dismiss='alert'>&times;</button>
                Merhaba <?php echo $row['user_name']; ?>  Sayfasına hoşgeldiniz
            </div>
            <div class="col-md-9">
            	<div id="dynamic">
					<?php
					echo "<fieldset>";
					while ($rowAttribute = $stmt2->fetch(PDO::FETCH_ASSOC)) {
					    if($rowAttribute["type"] == "table"){
					        echo "<legend>Table</legend>";
					        echo '<p>' .$rowAttribute["html"] .'</p></br></br>';
					    }
					    else if($rowAttribute["type"] == "img"){
					        echo "<legend>Image</legend>";
					        echo '<p>' .$rowAttribute["html"] .'</p></br></br>';
					    }
					    else if($rowAttribute["type"] == "p"){
					        echo "<legend>P</legend>";
					        echo $rowAttribute["html"] .'</br></br>';
					    }
					    else{
					        echo "<legend>A</legend>";
					        echo '<p>' .$rowAttribute["html"] .'</p></br></br>';
					    }
					}
					echo "</fieldset>";
                    ?>
                </div>
            </div>
        </div>
    </div>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>