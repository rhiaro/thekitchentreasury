<?
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('../getimages.php');
$now = new DateTime();
$thisweek = $now->format("jS F Y");
$success = False;

$days = get_days("../days.csv");

if(isset($_POST['update'])){

  $msg = "";

  if($_FILES["menu"]["error"] >= 6){
    $msg = "Something went wrong on the server, please try again, and if that doesn't work contact Amy.. (error code ".$_FILES["menu"]["error"].")";
  }elseif($_FILES["menu"]["error"] == 4){
    $msg = "Menu not updated.";
  }elseif($_FILES["menu"]["error"] >= 2){
    $msg = "Something went wrong with your file, please try again.";
  }elseif($_FILES["menu"]["error"] > 0){
    $msg = "File too big, please try again with a smaller file.";
  }elseif(isset($_FILES["menu"]) && !stripos($_FILES["menu"]["type"], "jpg") && !stripos($_FILES["menu"]["type"], "jpeg") && !stripos($_FILES["menu"]["type"], "png")){
    $msg = "Please upload a .jpg file";
  }

  if(empty($msg)){
    $uploaddir = '../img/menus/';
    $uploadfile = $uploaddir . basename($now->format("Ymd").".jpg");

    if (move_uploaded_file($_FILES['menu']['tmp_name'], $uploadfile)) {
      $success = True;
      $msg = "Menu updated.";
    }else{
      $msg = "Your file was okay, but something went wrong with saving it. Please try again.";
    }

  }

  if($_POST["days"] != $days){
    $days = write_days($_POST["days"]);
    $msg .= " Delivery days updated.";
    $success = True;
  }else{
    $msg .=" Delivery days not updated.";
  }

}

if(!$days){
  $days = array();
}

$latest_menu = get_images('menus', true, true);
$menu_date = date_from_filename($latest_menu);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/tiffin.css">
  <title>[Admin] The Tiffin</title>
  <meta name="description" content="Homecooked Punjabi street food, delivered to you, in Kirkcaldy and Fife">
</head>
<body class="admin">
  <header>
    <h1><img src="../img/logo.png" alt="The Tiffin" /></h1>
  </header>
  <main>
    <section id="intro">
      <h2>Update homepage</h2>
      <?if(isset($msg)):?>
        <p class="<?=$success ? "success":"fail"?>"><?=$msg?></p>
      <?endif?>
      <form method="post" enctype="multipart/form-data">
      <p><label for="menu">Upload menu for week of <?=$thisweek?>:</label></p>
      <p>
        <input type="file" name="menu" id="menu" />
      </p>
      <p><label for="days">Change delivery days for week of <?=$thisweek?>:</label></p>
      <p>
        <input name="days[]" value="Friday" id="fri" type="checkbox"<?=in_array("Friday",$days) ? " checked" : ""?> /><label for="fri">Friday</label>
        <input name="days[]" value="Saturday" id="sat" type="checkbox"<?=in_array("Saturday",$days) ? " checked" : ""?> /><label for="sat">Saturday</label>
        <input name="days[]" value="Sunday" id="sun" type="checkbox"<?=in_array("Sunday",$days) ? " checked" : ""?> /><label for="sun">Sunday</label>
      </p>
      <p><input type="submit" class="btn" name="update" value="Update" /></p>
      </form>
      <p><em>Menu last updated: <?=$menu_date?></em></p>
    </section>
    <section id="menu">
      <img src="<?=$latest_menu?>" />
    </section>
  </main>
  <footer>
  </footer>
</body>
</html>
