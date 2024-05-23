<?php 
if(isset($_SESSION['userdata']) && isset($_SESSION['userdata']['id'])){
    echo "<script>location.replace('./?page=profile')</script>";
    exit;
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
    extract($_POST);
    $conn = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);

    $qry_user = "SELECT * FROM `users` where `username` = ? or `email` = ? limit 1";
    $stmt = $conn->prepare($qry_user);
    $stmt->bind_param('ss', $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $data = $result->fetch_assoc();
        $is_pw_verified = password_verify($password, $data['password']);
        if($is_pw_verified){
            foreach($data as $k=>$v){
                if(!in_array($k, ['password'])){
                    $_SESSION['userdata'][$k] = $v;
                }
            }
            $conn->close();
            echo "<script>location.href = './?page=profile'</script>";
            exit;
        }else{
            $error = "Password is incorrect";
        }
        // $result = $stmt->get_result();
    }else{
        $error = "Incorrect Username/Email or Password";
    }
    $conn->close();
    // print_r($result->fetch_assoc());exit;

}
?>
<div class="col-lg-8 col-md-10 col-sm-12 col-xs-12 mx-auto">
    <h2 class="text-center">Welcome to <?= $_ENV['SITE_TITLE'] ?></h2>
    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4 mx-auto">
        <hr class="border-primary" style="border-top-width:3px;opacity:1">
    </div>
</div>
<div class="col-lg-4 col-md-5 col-sm-10 col-xs-12 mx-auto">
    <div class="card shadow rounded-0">
        <div class="card-header rounded-0">
            <div class="card-title">System Login Form</div>
        </div>
        <div class="card-body rounded-0">
            <div class="container">
                <form action="" method="POST" id="login-form">
                    <?php if(isset($error) && !empty($error)): ?>
                    <div class="mb-3 alert alert-danger rounded-0">
                       <?= $error ?>
                    </div>
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="username" class="control-label">Username/Email</label>
                        <input type="text" class="form-control rounded-0" id="username" name="username" autofocus="autofocus" required="required" value="<?= isset($_POST['username']) ? $_POST['username'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="control-label">Password</label>
                        <input type="password" class="form-control rounded-0" id="password" name="password" required="required" value="<?= isset($_POST['password']) ? $_POST['username'] : '' ?>">
                    </div>
                </form>
            </div>
        </div>
        <div class="card-footer rounded-0 text-center">
            <button class="btn btn-primary rounded-0" type="submit" form="login-form">Login</button>
        </div>
    </div>
</div>