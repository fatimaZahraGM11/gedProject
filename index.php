<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP SAFAE</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>list of Clients</h2>
        <a class="btn btn-primary" href="/SAFAEPHP/create.php" role="button">New Client</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>name</th>
                    <th>Email</th>
                    <th>phone</th>
                    <th>Adress</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
               $servername ="localhost";
               $username = "root";
               $password = "";
               $database = "gedproject";
               
               // Création de la connexion
               $connection = new mysqli($servername, $username, $password, $database);
               
               // Vérification de la connexion
               if ($connection->connect_error) {
                   die("La connexion a échoué : " . $connection->connect_error);
               }       $servername = "localhost";
         

                //read all row from database table
                $sql=" SELECT  * FROM clients";
                $result = $connection-> query($sql);

                if(!$result) {
                    die("Invalid query :" . $connection->error);
                }

                //read adata for each row
                while($row= $result->fetch_assoc()){
                    echo"
                    <tr>
                    <td>".$row['id']."</td>
                    <td>$row[name]</td>
                    <td>$row[email]</td>
                    <td>$row[phone]</td>
                    <td>$row[address]</td>
                    <td>$row[created_at]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='./edit.php?id=$row[id]'>Edit</a>
                        <a class='btn btn-danger btn-sm' href='./delet.php?id=$row[id]'>delet</a>
                    </td>
                </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>    
    <div class="container mt-5">
		<h2>Upload a file</h2>
		<form action="./uploadfile.php" method="POST" enctype="multipart/form-data">
			<div class="mb-3">
				<label for="file" class="form-label">Select file</label>
				<input type="file" class="form-control" name="file" id = "file">
			</div>
			<button type="submit" class="btn btn-primary">Uploadfile</button>
		</form>
	</div>
    <script>
        // Function to display notification
        function showNotification(message, type) {
            var notification = document.getElementById('notification');
            notification.textContent = message;
            notification.className = 'notification ' + type;
            notification.style.display = 'block';
            setTimeout(function() {
                notification.style.display = 'none';
            }, 5000); // Hide the notification after 5 seconds
        }

        <?php if(isset($_GET['upload']) && $_GET['upload'] == 'success'): ?>
            showNotification('File uploaded successfully.', 'success');
        <?php elseif(isset($_GET['upload']) && $_GET['upload'] == 'error'): ?>
            showNotification('Sorry, there was an error uploading your file.', 'error');
        <?php endif; ?>
    </script>
</body>
</html>