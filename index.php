<?php
// Start the session
session_start();
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php
                if($_SESSION['username']){
                    echo "Hoşgeldin ". $_SESSION['username']. " <a href='logout.php'> çıkmak için tıklayın.</a>";
                }
                else{
                    echo "Henüz giriş yapmadınız.";
                }
                ?>
            </div>
        </div>
        <div class="row">
            <?php
            if($_SESSION['access_token']){
                $user = $_SESSION['access_token'];
                
                echo "Kullanıcı adın @".$user['screen_name'];
            }
            else
            {
                echo '<a href="twapp/">Token kaydı için tıklayın.</a>';
            }
            ?>
        </div>


    	<div class="row">
    	<?php
            if(!isset($_SESSION['username'])){ ?>
        	<div class="col-md-6 col-md-offset-3">
    		  <h4 class="text-center">KAYIT FORMU </h4>
    			<div class="form-group">
    				<form class="form" action="kaydet.php" method="POST">
    					<label>Kullanıcı Adı</label>
        				<input class="form-control" type="text" name="username" />
        				<label>Şifre</label>
        				<input class="form-control" type="text" name="password" />
        				<input class="btn btn-primary form-control" type="submit" value="KAYDET" />
        			</form>
    			</div>
    		</div>
        	<div class="col-md-6 col-md-offset-3">
              <h4 class="text-center">GİRİŞ FORMU </h4>
                <div class="form-group">
                    <form class="form" action="giris.php" method="POST">
                        <label>Kullanıcı Adı</label>
                        <input class="form-control" type="text" name="username" />
                        <label>Şifre</label>
                        <input class="form-control" type="text" name="password" />
                        <input class="btn btn-primary form-control" type="submit" value="GİR" />
                    </form>
                </div>
            </div>
            <?php }else{ ?>

            <div class="col-md-6 col-md-offset-3">
              <h4 class="text-center">Tweet Gönder</h4>
                <div class="form-group">
                    <form class="form" action="newtweet.php" method="GET">
                        <label>Mesajın</label>
                        <input class="form-control" type="text" name="message" />
                        <input class="btn btn-primary form-control" type="submit" value="GÖNDER" />
                    </form>
                </div>
            </div>
            <div class="col-md-6 col-md-offset-3">
              <h4 class="text-center">Resimli Tweet Gönder</h4>
                <div class="form-group">
                    <form class="form" action="newimagetweet.php" method="POST" enctype="multipart/form-data">
                        <label>Mesajın</label>
                        <input class="form-control" type="text" name="message" />
                        <label>Resim dosyası</label>
                        <input class="form-control" type="file" name="image" />
                        <input class="btn btn-primary form-control" type="submit" value="GÖNDER" />
                    </form>
                </div>
            </div>
            <div class="col-md-6 col-md-offset-3">
              <h4 class="text-center">Kullanıcı Tweetlerini getir</h4>
                <div class="form-group">
                    <form class="form" action="get_user_timeline.php" method="GET">
                        <label>Kullanıcı adı</label>
                        <input class="form-control" type="text" name="user" />
                        <label>Getirilecek tweet sayısı</label>
                        <input class="form-control" type="number" name="count" />
                        <input class="btn btn-primary form-control" type="submit" value="GÖNDER" />
                    </form>
                </div>
            </div>
            <div class="col-md-6 col-md-offset-3">
              <h4 class="text-center">Tweet arama</h4>
                <div class="form-group">
                    <form class="form" action="search.php" method="GET">
                        <label>Arama Yap</label>
                        <input class="form-control" type="text" name="q" />
                        <label>Arama tipi</label>
                        <select class="form-control" name="result_type">
                            <option value="mixed">Karışık</option>
                            <option value="recent">Güncel</option>
                            <option value="popular">Popüler</option>
                        </select>
                        <label>Getirilecek tweet sayısı</label>
                        <input class="form-control" type="number" name="count" />
                        <label>Hangi tarihe kadar arama yapılsın.</label>
                        <input class="form-control" type="date" name="until" />
                        <input class="btn btn-primary form-control" type="submit" value="GÖNDER" />
                    </form>
                </div>
            </div>
            


            <?php } ?>

        </div>



    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>