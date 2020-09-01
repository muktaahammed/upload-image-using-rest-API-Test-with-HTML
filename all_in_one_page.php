<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "dbimage_upload_test";

$conn = mysqli_connect($servername, $username, $password, $db);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>    

<?php    
    //Database: dbimage_upload_test »Table: user_table
    //id	user_image	user_name

    $msg = "";
    if(isset($_POST['AddUser'])){
        

        $username = $_POST['username'];
        //this adimage is the name of the input field
        if (is_uploaded_file($_FILES["adimage"]["tmp_name"]) ){
            //adimage is the variable name of input field
            $tmp_file = $_FILES["adimage"]["tmp_name"];
            $img_name = $_FILES["adimage"]["name"];
            $upload_dir = "./images/".$img_name;
            // user_image user_name are the database fields name $img_name also a variable where we keep the adimage varibale
            $query = "INSERT INTO user_table(user_image, user_name) VALUES ('$img_name', '$username')";
            //when successfully upload the image the image goes to the directed folder which one you select
            if(move_uploaded_file($tmp_file, $upload_dir) && $conn->query($query)){
            
                $response["MESSAGE"] = "UPLOAD SUCCESS";
                $response["STATUS"] = 200;
                $msg = "Image successfully uploaded";
                //header will help you to redirect the page when successfully uplade the image
            // header('Location: index.php');

            }
            else{
                $response["MESSAGE"] = "UPLOAD FAILED";
                $response["STATUS"] = 404;
            }
        }
    }
    mysqli_close($conn); 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="login form">
    <meta name="author" content="rbf trchnology">
       <title>Upload Image Example</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="../bootstrap/js/admin.js"></script>

    <!-- For selceted image to view -->
    <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" 
    integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
        integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY"
        crossorigin="anonymous">
    </script>

    <!-- Goole Icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Our Custom CSS -->
    <link href="../../bootstrap/custom_css/left_nav.css" rel="stylesheet" id="style">
    <link href="../../bootstrap/custom_css/admin.css" rel="stylesheet" id="style">
    <!-- For selceted image to view -->
</head>
<body class="body-design bg-warning">
    <div class="container">
    <div class="col mb-4">
        <form method="POST" action="#" name="contactform" enctype="multipart/form-data">
            <div class="row">
                <div class="col-6">
                    <h3 class="text-center">Add New User</h3>
                               
                    <div class="form-group">
                        <input type='file' name="adimage" onchange="readURL(this);" />                        
                    </div>

                    <div class="form-group">
                        <label for="inputAddress">User name<sup class="text-danger">*</sup></label>
                        <input type="text" name="username" class="form-control bg-light" id="inputAddress"
                            placeholder="" required>
                    </div>

                                        
                    <button type="submit" name="AddUser" class="btn btn-primary btn-sm btn-block">Add new admin</button>
                    <h5 class="text-danger"><?= $msg?></h5>
                </div>
                
            </div>
        </form>
    </div>
</div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"crossorigin="anonymous"></script>
        <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>

</body>
</html>