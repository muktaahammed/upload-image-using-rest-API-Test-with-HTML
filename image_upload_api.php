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
                $code["STATUS"] = 200;                  
                //header will help you to redirect the page when successfully uplade the image
                
                // When you use this code as your API you must delete this header and echo. otherwise it shows an error
                // header('Location: index.php');
                echo "Image successfully uploaded";

            }
            else{
                $response["MESSAGE"] = "UPLOAD FAILED";
                $code["STATUS"] = 404;
            }
        }
    }
    mysqli_close($conn); 
?>