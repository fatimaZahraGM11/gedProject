<?php
$name="";
$Email="";
$phone="";
$address="";

$errorMessage="";
$successMessage="";
$connection = new mysqli('localhost','root','','gedproject');
if ($_SERVER['REQUEST_METHOD'] == 'GET' ) {
    
    // get method: show the data of the client
    
    if ( !isset($_GET["id"]) ) {
        header("location: ./index.php");
        exit;
    }

    $id = $_GET["id"];

    //read the row of the select client from database table
    $sql ="SELECT * FROM clients WHERE id=$id";
   
    $result= $connection->query ($sql);
    $row=$result->fetch_assoc();

    if (!$row) {
        header("location: ./index.php");
        exit;
    }
    $name = $row["name"];
    $email = $row["email"];
    $phone = $row["phone"];
    $address = $row["address"];
}
else {
    //Post method: Update the data of the clients
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["adress"];

    do{
        if ( empty($id) || empty($name) || empty($phone) || empty($address)) {
            $errorMessage=" All the fields are required";
            break;
        }

      
      

        $sql="UPDATE clients SET name = '$name', email = '$email', phone = '$phone', address = '$address' WHERE id = $id";
      

        
           $result = $connection->query($sql);
           if (!$result) {
            $errorMessage = "Invalid query: " - $connection->error;
            break;
           }

           $successMessage="Client updated correctly";
           header("location: ./index.php");
           exit;
    }while(true);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
    <div class="container my-5"> 
        <h2>New Client</h2>
        <?php
        if ( !empty($errorMessage) ) {
            echo"
            <div class='alert alert-warning alert-dismissible fade show' role-'alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
            </div>
            ";
        }
        ?>
        <form method="post" action="./edit.php"> 
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row nb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($address); ?>">
                </div>
            </div>

            <div class="row nb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>

            <div class="row nb-3">
                <label class="col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
                </div>
            </div>

            <div class="row nb-3">
                <label class="col-sm-3 col-form-label">Adress</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="adress" value="<?php echo $address; ?>">
                </div>
            </div>

            <?php
            if ( !empty($successMessage) ) {
                echo"
                <div class-'row mb-3'>
                  <div class='offset-sm-3 rol-sm-6'>
                      <div class='alert alert-success alert-dismissible fade show' role-'alert'>
                         <strong>$successMessage</strong>
                         <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                      </div>
                  </div>
                </div>
                ";
            }
            ?>

            <div class="row nb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="./index.php" role="button">cancel</a>
                </div>  
            </div>

        </form>
    </div>
</body>
</html>