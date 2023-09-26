<?php

function create_user(){

    global $conn;
    
    if(isset($_POST["submit"])){
        $name = $_POST["name"];
    
        $image = $_FILES["image"]["name"];
        $tmp_image = $_FILES["image"]["tmp_name"];
        move_uploaded_file($tmp_image, "./images/{$image}");
    
        $post_sql = "INSERT INTO user (name, image) VALUES ('{$name}', '{$image}')";
    
        $post_query = mysqli_query($conn, $post_sql);
    }
}

function display_user(){

    global $conn;

    $select_sql = "SELECT * FROM user";

                        $select_query = mysqli_query($conn, $select_sql);

                        while($row_data = mysqli_fetch_assoc($select_query)){
                            $user_id = $row_data["id"];
                            $user_name = $row_data["name"];
                            $user_image = $row_data["image"];

                            echo "<tr>
                            <th scope='row'>'{$user_id}'</th>
                            <td>'{$user_name}'</td>
                            <td><img src='./images/{$user_image}' width='100' /></td>
                            <td><a href='index.php?edit={$user_id}' style='text-decoration: none; color: green;'>Edit</a></td>
                            <td><a href='index.php?delete={$user_id}' style='text-decoration: none; color: red;'>Delete</a></td>
                        </tr>";
                        }
}


function update_user(){

    global $conn;
    

    if(isset($_GET["edit"])){
        $edit_id =$_GET["edit"];
        
        $edit_sql = "SELECT * FROM user WHERE id = '{$edit_id}'";
        $edit_query= mysqli_query($conn, $edit_sql);

        if(!$edit_query){
            die("Something went Wrong!" . mysqli_error($edit_query));
        }

        while($update_row = mysqli_fetch_assoc($edit_query)){
            $update_id = $update_row["id"];
            $update_name = $update_row["name"];
            ?>

<h3 class="my-5">Update Form:</h3>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="text-input">Enter Name:</label>
        <input type="text" value=<?php echo $update_name; ?> class="form-control" id="text-input" name="name"
            placeholder="Enter Name">
    </div>
    <div class="form-group my-4">
        <label for="image-input">Profile Image:</label>
        <input type="file" class="form-control-file" id="image-input" name="image">
    </div>
    <button type="submit" name="update" class="btn btn-primary">Update</button>
</form>;
<?php }} ?>
<?php

if(isset($_POST["update"])){
    $update_user_name = $_POST["name"];
    $update_user_image = $_FILES["image"]["name"];
    $update_user_image_tmp = $_FILES["image"]["tmp_name"];
    move_uploaded_file($update_user_image_tmp, './images/{$update_user_image}');
    
    $update_user_sql = "UPDATE user SET name = '{$update_user_name}', image = '{$update_user_image}' WHERE id = '{$edit_id}'";

    $update_user_query = mysqli_query($conn, $update_user_sql);

    if(!$update_user_query){
        die("Can not be Updated!" . mysqli_error($update_user_query));
    }else{
        header("Location: index.php");
    }
}
}

function delete_user(){

    global $conn;
    
    if(isset($_GET["delete"])){
        $delete_id = $_GET["delete"];

        $delete_sql = "DELETE FROM user WHERE id = '{$delete_id}'";
        $delete_query = mysqli_query($conn, $delete_sql);

        if(!$delete_query){
            die("Can not be deleted!" . mysqli_error($delete_query));
        }
    }
}




?>