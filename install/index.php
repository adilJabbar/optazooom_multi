
<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="Author" content="GeniusOcean">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> GeniusOcean - Script Installer</title>
	<!-- favicon -->
	<link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
	<!-- bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">

	<link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<?php

	define('GENIUSOCEAN','https://geniusocean.com/verify/');
	ini_set('max_execution_time', 300);

	$step = 0;
	$error = 0;
	if(isset($_GET['step']) && $_GET['step'] != ''){
		$step = $_GET['step'];
	}else{
		$step = 1;
	}



	error_reporting(0);

	function check_extension($name){
		if (!extension_loaded($name)) {
			$response = false;
		} else {
			$response = true;
		}
		return $response;
	}
	
	function check_permission($name){
	$perm = substr(sprintf('%o', fileperms($name)), -4);
		if ($perm >= '0775') {
		  $response = true;
		} else {
		   $response = false;
		}
	return $perm;
	}
	
	function importDatabase($mysql_host,$mysql_database,$mysql_user,$mysql_password){
	  $db = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);
	  $query = file_get_contents("database.sql");
	  $stmt = $db->prepare($query);
	  if ($stmt->execute())
		 return true;
	  else 
		 return false;
	}
	
	$base_url = home_base_url();
	if (substr($base_url, -1 == "/")) {
		$base_url = rtrim($base_url,"/");
	}
	
	function home_base_url(){   
	  $base_url = (isset($_SERVER['HTTPS']) &&
	  $_SERVER['HTTPS']!='off') ? 'https://' : 'http://';
	  $tmpURL = dirname(__FILE__);
	  $tmpURL = str_replace(chr(92),'/',$tmpURL);
	  $tmpURL = str_replace($_SERVER['DOCUMENT_ROOT'],'',$tmpURL);
	  $tmpURL = ltrim($tmpURL,'/');
	  $tmpURL = rtrim($tmpURL, '/');
	  $tmpURL = str_replace('install','',$tmpURL);
	  $base_url .= $_SERVER['HTTP_HOST'].'/'.$tmpURL;
	  return $base_url; 
	}
	
	function printResult($title, $summary, $status){
		if ($status) {
			$icon = '<i class="far fa-check-circle"></i>';
		}else{
			$icon = '<i class="far fa-times-circle" style="color:red;"></i>';
		}

		echo '<li class="list-group-item d-flex justify-content-between align-items-cente">
		<span class="left">
			'.$title.'<small class="d-block">'.$summary.'</small>
		</span>
		<span class="right">
		'.$icon.'
		</span>
		</li>';
	
	
	}

	$extensions = [
		'openssl' ,'pdo', 'mbstring', 'tokenizer', 'JSON', 'cURL', 'XML', 'fileinfo'
	];
	
	$folders = [
		'project/vendor/', 'project/storage/', 'project/storage/app/', 'project/storage/framework/', 'project/storage/logs/'
	];

?>


	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-7">
				<div class="installer-wrapper">
					<div class="installer-box">
						<div class="heading-area">
							<h4 class="title">
									<i class="fas fa-cogs"></i> GeniusOcean Installer
							</h4>
						</div>
						<div class="content">
							<div class="process-steps-area">
								<ul class="nav process-steps" role="tablist">
									<li class="nav-item <?= $step==1?'active':'' ?>">
									  <a class="icon active" href="javascript:;">
										<i class="fas fa-<?= $step<2?'home':'check' ?>"></i>
									  </a>
									</li>
									<li class="nav-item <?= $step==2?'active':'' ?>">
									  <a class="icon" href="javascript:;">
										<i class="fas fa-<?= $step< 3?'cogs':'check' ?>"></i>
									  </a>
									</li>
									<li class="nav-item <?= $step==3?'active':'' ?>">
									  <a class="icon" href="javascript:;">
										<i class="fas fa-<?= $step< 4?'list-ul':'check' ?>"></i>
									  </a>
									</li>
									<li class="nav-item <?= $step==4?'active':'' ?>">
										<a class="icon" href="javascript:;">
											<i class="fas fa-<?= $step< 5?'cog':'check' ?>"></i>
										</a>
									</li>
									<li class="nav-item <?= $step=='completed'?'active':'' ?>">
									  	<a class="icon" href="javascript:;">
											<i class="fas fa-hourglass-end"></i>
										</a>
									</li>
								  </ul>
							</div>
							<div class="main-content">
								<div class="tab-content" id="pills-tabContent">
									<div class="tab-pane fade <?= $step==1?'show active':'' ?>" id="pills-stap1" role="tabpanel" aria-labelledby="pills-stap1-tab">
										<div class="text-center">
										<h4>
											Easy Installation Wizerd
										</h4>
										<strong class="blink_me">You can use it for ONE DOMAIN only!</strong> <br><br>
</div>
  			<ul class="list-group">
											<li class="list-group-item you-can"><i class="far fa-check-circle"></i> Modify Or Customization is allowed.</li>
											<li class="list-group-item you-can"><i class="far fa-check-circle"></i> One purchase key for one website only.</li>
											<li class="list-group-item you-cant"><i class="far fa-times-circle"></i> Can't use it for multiple domain</li>
											<li class="list-group-item you-cant"><i class="far fa-times-circle"></i> Can't use one purchase key for multiple customers</li>
											<li class="list-group-item you-cant"><i class="far fa-times-circle"></i> Must activate the website within 30 days of installation</li>
											
										</ul>
											
										<div class="footer-area">
											<a href="?step=2" class="next-btn">Start Installation<i class="fas fa-chevron-right"></i> </a>
										</div>
									</div>
									<div class="tab-pane fade <?= $step==2?'show active':'' ?>" id="pills-stap2" role="tabpanel" aria-labelledby="pills-stap2-tab">
									<div class="text-center">
										<h4>
											Server Requirements
										</h4>
										<?= $error != 0?'<strong style=color:red>Please Meet All requirements!</strong>':'' ?>
									</div>	
									<div class="inner-box">
											<ul class="list-group">

<?php

if($step == 2)	{
	$phpversion = version_compare(PHP_VERSION, '7.1.3', '>=');
	if ($phpversion==true) {
	$error = $error+0;
	printResult("PHP", "Required PHP version 7.1.3 or higher",1);
	}else{
	$error = $error+1;
	printResult("PHP", "Required PHP version 7.1.3 or higher",0);
	}
	foreach ($extensions as $key) {
		$extension = check_extension($key);
		if ($extension==true) {
		$error = $error+0;
		printResult($key, "Required ".strtoupper($key)." PHP Extension",1);
		}else{
		$error = $error+1;
		printResult($key, "Required ".strtoupper($key)." PHP Extension",0);
		}
	}

	$envCheck = is_writable('../project/.env');
	if ($envCheck==true) {
	$error = $error+0;
	printResult('env'," Required .env to be writable",1);
	}else{
	$error = $error+1;
	printResult('env'," Required .env to be writable",0);
	}
	$database = file_exists('database/database.sql');
	if ($database==true) {
	$error = $error+0;
	printResult('Database',"  Required database.sql available",1);
	}else{
	$error = $error+1;
	printResult('Database'," Required database.sql available",0);
	}
}

?>


											</ul>
										</div>
										<?= $error != 0?'<p class="check-error">Please Meet All requirements!<br>If you can not profile permission. Contact your hosting provide.</p>':'' ?>
										
										<div class="footer-area">
											<a href="?step=1" class="next-btn"><i class="fas fa-chevron-left"></i> Back</a>
											<a href="?step=3" class="next-btn" <?= $error != 0?'disabled':'' ?>>Check Permissions<i class="fas fa-chevron-right"></i> </a>
										</div>
									</div>
									<div class="tab-pane fade <?= $step==3?'show active':'' ?>" id="pills-stap25" role="tabpanel" aria-labelledby="pills-stap25-tab">
									<div class="text-center">
										<h4>
											Folder Permissions
										</h4>
										
									</div>
									<div class="inner-box">
											<ul class="list-group">

<?php
if($step == 3)	{
	foreach ($folders as $key) {
		if(file_exists('../'.$key)){
			$folder_perm = check_permission('../'.$key);
			if ($folder_perm==true) {
			$error = $error+0;
			printResult(str_replace("../", "", $key)," Required permission: 0775 ",1);
			}else{
			$error = $error+1;
			printResult(str_replace("../", "", $key)," Required permission: 0775 ",0);
			}
		}else{
			$error = $error+1;
			printResult($key," Folder Not Found!",0);
		}
		
	}

}

	
?>
												

											</ul>
										</div>
										
										<?= $error != 0?'<p class="check-error">Please Meet All requirements!<br>If you can not profile permission. Contact your hosting provide.</p>':'' ?>
										<div class="footer-area">
											
											<a href="?step=2" class="next-btn"><i class="fas fa-chevron-left"></i> Back</a>
											<a href="?step=4" class="next-btn" <?= $error != 0?'disabled':'' ?>>Configure Database<i class="fas fa-chevron-right"></i> </a>
										</div>
									</div>
									<div class="tab-pane fade <?= $step==4?'show active':'' ?>" id="pills-stap3" role="tabpanel" aria-labelledby="pills-stap3-tab">
										
										<form action="" method="POST" id="installer">
											<div class="inner-box">
											<div class="gocover" style="background: url(assets/css/hourglass.gif) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                      
											<?php
											//if($error_msg != ''){
											?>
											<div class='errors'>
												
											</div>
											<?php
											// }
											?>

												<div class="install-form">
														<div class="form-input">
															<input type="text" name="web_name" placeholder="Enter Website Name" required="">
															<i class="fas fa-globe-americas"></i>
														</div>
														<div class="form-input">
															<input type="text" name="web_url" placeholder="Enter Website URL" required="">
															<i class="fas fa-link"></i>
														</div>
														<div class="form-input">
															<input type="text" name="database_host" placeholder="Enter Database Host" required="">
															<i class="fas fa-database"></i>
														</div>
														<div class="form-input">
															<input type="text" name="database_name" placeholder="Enter Database Name" required="">
															<i class="fas fa-database"></i>
														</div>
														<div class="form-input">
															<input type="text" name="database_username" placeholder="Enter Database Username" required="">
															<i class="fas fa-user"></i>
														</div>
														<div class="form-input">
															<input type="text" name="database_password" placeholder="Enter Database Password" required="">
															<i class="fas fa-lock"></i>
														</div>
												</div>
											</div>
											<div class="footer-area">
												<a href="?step=3" class="next-btn"><i class="fas fa-chevron-left"></i> Back</a>
												<a href="javascript:;" class="next-btn" id="submit-btn">Run Install<i class="fas fa-chevron-right"></i> </a>
											</div>
										</form>
									</div>
									<div class="tab-pane fade <?= $step=='completed'?'show active':'' ?>" id="pills-stap4" role="tabpanel" aria-labelledby="pills-stap4-tab">
										
										<div class="inner-box">
											<div class="confirm-message">
													<i class="far fa-check-circle"></i>
													<h4 style="color:green">
														Your Installation is completed Successfully!
													</h4>
											</div>
											
											<div class="info-table">
												<table class="table">
												<tr>
													<td>
															Website link 
													</td>
													<td>
														:
													</td>
													<td>
														<a href="<?=$base_url ?>/finalize"><?=$base_url ?></a>
													</td>
												</tr>
												<tr>
													<td>
															Admin link
													</td>
													<td>
														:
													</td>
													<td>
														<a href="<?=$base_url ?>/admin"><?=$base_url ?>/admin</a>
													</td>
												</tr>
												<tr>
													<td>
															Admin ID
													</td>
													<td>
														:
													</td>
													<td>
														<p>
															admin@gmail.com
														</p>
													</td>
												</tr>
												<tr>
													<td>
															Admin Password
													</td>
													<td>
														:
													</td>
													<td>
														<p>
															1234
														</p>
													</td>
												</tr>
														
												</table>
											</div>
										</div>

										<div class="footer-area">
												<a href="<?= $base_url?>/finalize" class="next-btn">Complete the process<i class="fas fa-chevron-right"></i> </a>
											</div>
									</div>
									
								  </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- jquery -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script>
		var domain_URL = "<?php echo $base_url;?>";
	</script>
	<script src="assets/js/main.js"></script>
</body>

</html>