    <?php include "../admin/page/library/checkroles.php";
      protectPathAccess();
    ?>

<!DOCTYPE html>
<html>
    
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Dashboard</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="assets/css/ready.css">
	<link rel="stylesheet" href="assets/css/demo.css">
	<link rel="stylesheet" href="assets/css/style.css">
	
</head>

<body>
    <div class="wrapper">
        <div class="main-header">
            <div class="logo-header">
                <a href="#" class="logo">
                    Dashboard
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>

            <!-- navbar -->
            </div>
            <!-- Corrected path for navbar.php -->
            <?php include "./page/include/navbar.php"; ?>
        </div>

        <!-- sidebar -->
        <div class="sidebar">
            <!-- Corrected path for sidebar.php -->
            <?php include "./page/include/sidebar.php"; ?>
        </div>

        <div class="main-panel" id="content">
            <?php include "./page/include/content.php"; ?>

            <!-- 
            <footer class="footer">
                
            </footer> 
            -->
        </div>
    </div>
</div>
</body>

<!-- Corrected path for js.php -->
<?php include "./page/include/js.php"; ?>

</body>
</html>
