<?php 
    session_start();
    require './class/db.php';
    require './class/User.php';
    $user=""; $pass="";
    $errUser="";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $user=$_POST['username'];
      $pass=$_POST['password'];
      $database=new Database();
      $db=$database->getConnect();
      $user= new User($db,$user,$pass);
      $stmt= $user->checkLoginAdmin();
      if($stmt==1){
        $_SESSION['Role']='Admin';
        $_SESSION['arrSizes']=array();
        $_SESSION['arrColors']=array();
        header("location: ./home/index.php");
        exit;
      }else{
        $errUser="Wrong username or password!!!";        
      }
      
    }
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link rel="shortcut icon" type="image/png" href="./assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="./assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="#" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="./assets/images/logos/dark-logo.svg" width="180" alt="">
                </a>
                <p class="text-center">Your Social Campaigns</p>
                <form method="post" enctype="multipart/form-data" >
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $user ?>">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" value="<?php echo $pass ?>">
                  </div>
                  <?php echo "<p class='text-danger'>$errUser</p>" ?>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" >Sign In</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">New to Modernize?</p>
                    <a class="text-primary fw-bold ms-2" href="./authentication-register.html">Create an account</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>