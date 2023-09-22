<?php 

include './includes/db.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php
                
                if(isset($_POST["submit"])){
                    $name = $_POST["name"];

                    $image = $_FILES["image"]["name"];
                    $tmp_image = $_FILES["image"]["tmp_name"];
                    move_uploaded_file($tmp_image, "./images/{$image}");

                    $post_sql = "INSERT INTO user (name, image) VALUES ('{$name}', '{$image}')";

                    $post_query = mysqli_query($conn, $post_sql);
                }
                
                ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="text-input">Enter Name:</label>
                        <input type="text" class="form-control" id="text-input" name="name" placeholder="Enter Name">
                    </div>
                    <div class="form-group my-4">
                        <label for="image-input">Profile Image:</label>
                        <input type="file" class="form-control-file" id="image-input" name="image">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-md-6">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Profile</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>