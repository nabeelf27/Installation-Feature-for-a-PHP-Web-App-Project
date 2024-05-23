<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $conn = false;
    // ob_start();
    $conn = new mysqli($_POST['DB_HOST'], $_POST['DB_USERNAME'], $_POST['DB_PASSWORD']);
    if ($conn->connect_error) {
        $error = 'Unable to connect to the database. Please check your credentials.';
    }
    
    if(!$conn){
        $error = "Given Database Credentials is incorrect";
    }else{
        $check_db = $conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '{$_POST['DB_NAME']}'")->num_rows;
        if($check_db > 0){
            $error = 'Database already exist. Please use a different name to prevent data loss on your database.';
        }else{
            // echo "CREATE DATABASE `{$_POST['DB_NAME']}`";
            // $conn->close();
            // exit;
            $create_db = $conn->query("CREATE DATABASE `{$_POST['DB_NAME']}`");
            if($create_db){
                $conn->select_db($_POST['DB_NAME']);
                include_once('./defaults/db.php');
                if(isset($db_sql)){
                    foreach($db_sql as $sql){
                        $conn->query($sql);
                        if($conn->error){
                            die($conn->error);
                        }
                    }
                }
                $update_env_vars = $__DotEnvironment->update_env_variables($_POST);
                if($update_env_vars){
                    echo "<script>location.href = './?step=4'</script>";
                    exit;
                }
            }else{
                $error = 'Database has failed to create due to some error occurred.';
            }
            $conn->close();
        }
    }

}
?>
<div class="container-fluid py-0">
    <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12 mx-auto mt-3">
        <div class="card rounded-0">
            <div class="card-header rounded-0">
                <div class="card-title"><b>Site Installation (Step 3 out of 4)</b></div>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <h4 class="text-center"><b>Database Credentials</b></h4>
                    <hr>
                    <p>Please fill all the required fields below.</p>
                    <?php if(isset($error) && !empty($error)): ?>
                    <div class="alert alert-danger">
                        <?= $error ?>
                    </div>
                    <?php endif; ?>
                    <form id="installation-form" action="" method="POST">
                        <div class="mb-3">
                            <label for="DB_HOST">Database Host<span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-0" id="DB_HOST" value="<?= isset($_POST['DB_HOST']) ? $_POST['DB_HOST'] : "localhost" ?>" name="DB_HOST" required="required">
                        </div>
                        <div class="mb-3">
                            <label for="DB_USERNAME">Database Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-0" id="DB_USERNAME" value="<?= isset($_POST['DB_USERNAME']) ? $_POST['DB_USERNAME'] : "" ?>" name="DB_USERNAME" required="required">
                        </div>
                        <div class="mb-3">
                            <label for="DB_PASSWORD">Database Password</label>
                            <input type="password" class="form-control rounded-0" id="DB_PASSWORD" name="DB_PASSWORD">
                        </div>
                        <div class="mb-3">
                            <label for="DB_NAME">Database Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-0" id="DB_NAME" name="DB_NAME" required="required"   value="<?= isset($_POST['DB_NAME']) ? $_POST['DB_NAME'] : "" ?>">
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-footer text-end">
                <button class="btn btn-primary" type="submit" form="installation-form">Save and Proceed to Next</button>
            </div>
        </div>
    </div>
</div>