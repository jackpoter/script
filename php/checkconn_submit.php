
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Check connection</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/jumbotron-narrow.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
      <div class="jumbotron">
        <!-- <h1>Jumbotron heading</h1> -->
        <p class="lead"><span style="font-weight: bold; font-family:'Microsoft YaHei'; font-size: 21px; ">测试TCP端口连通性</p></span>
        <!-- <p><a class="btn btn-lg btn-success" href="#" role="button">Sign up today</a></p>-->
      </div>

      <div class="row marketing">
        <div class="col-lg-6">

		<label for="ip">IP地址:
		<?php 

		class Health {
		  public static $status;
		  public function __construct()
		  {
		  }
		  public function check($ip, $port){
			$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
			socket_set_nonblock($sock);
			socket_connect($sock,$ip, $port);
			socket_set_block($sock);
			self::$status = socket_select($r = array($sock), $w = array($sock), $f = array($sock), 5);
			return(self::$status); 
		  }
		  public function checklist($lst){
		  }
		  public function status(){
			switch(self::$status)
			{
			  case 2:
				echo "端口关闭";
				break;
			  case 1:
				echo "端口打开";
				break;
			  case 0:
				echo "连接超时";
				break;
			}  
		  }
		}

		 if($_SERVER['REQUEST_METHOD'] == 'POST')
		 {
		 $ip=$_POST['ip'];
		 $port=$_POST['port'];
		 $health = new Health();
		 $health->check($ip, $port);
		 echo $ip . "</label><br>";
		 echo "<label for=\"port\">测试端口: " .  $port . " ";
		 $health->status();
		 echo "</label><br>";
		 }
		 else {
			 echo "<br>参数出错<br>";
		 } 
		?>

	</div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
