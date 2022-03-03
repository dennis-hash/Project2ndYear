<?php
    if(isset($_POST['add'])){

    if (($_FILES['product_image']['name'] !="")){
        $target_dir = "includes/";
        $file = $_FILES['my_file']['name'];
        $path = pathinfo($file);
        $filename = $path['filename'];
        $ext = $path['extension'];
        $temp_name = $_FILES['my_file']['tmp_name'];
        $path_filename_ext = $target_dir.$filename.".".$ext; 
    }
    // Check if file already exists
    if (file_exists($path_filename_ext)) {
        echo "Sorry, file already exists.";
    }else{
        move_uploaded_file($temp_name,$path_filename_ext);
        echo "Congratulations! File Uploaded Successfully.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h3>Admin Panel </h3>
    </header>
    <div class="addProduct">
       <form action="adminPage.php" method="POST" enctype='multipart/form-data'>
          <ul>
            <p>Product name</p>
            <input type="text" placeholder="Product name" name="product_name">
            <p>Price</p>
            <input type="number" placeholder="Product price" name="product_price">
            <p>Upload image</p>
            <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image">
            <input type="submit" name="add" value="ADD">
            </ul>
        </form>
    </div>
</body>
</html>





















             