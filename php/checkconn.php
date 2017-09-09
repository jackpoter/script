
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

	<form action="checkconn_submit.php" method="post" type="text/html">

	  <div class="form-group">
		<label for="ip">请输入IP地址:</label>
		<?php 
		function get_client_ip($type = 0) {
			$type       =  $type ? 1 : 0;
			static $ip  =   NULL;
			if ($ip !== NULL) return $ip[$type];
			if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
				$pos    =   array_search('unknown',$arr);
				if(false !== $pos) unset($arr[$pos]);
				$ip     =   trim($arr[0]);
			}elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
				$ip     =   $_SERVER['HTTP_CLIENT_IP'];
			}elseif (isset($_SERVER['REMOTE_ADDR'])) {
				$ip     =   $_SERVER['REMOTE_ADDR'];
			}
			// IP地址验证
			$long = sprintf("%u",ip2long($ip));
			$ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
			return $ip[$type];
		}
		echo "<input type=\"text\" class=\"form-control\" name=\"ip\" placeholder=\"默认显示浏览器IP\" value=\"". get_client_ip() . "\"/>";
		?>
	  </div>
	  <div class="form-group">
		<label for="port">请输入测试端口:</label>
		<input type="text" class="form-control" name="port" placeholder="输入测试端口，如 80"/>
	  </div>

	  <button type="submit" class="btn btn-primary" >Submit</button>
	</form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
