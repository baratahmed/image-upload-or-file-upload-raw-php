<?php
    $link = mysqli_connect('localhost', 'root', '', 'image_upload');
    if (isset($_POST['btn'])){
        $fileName = $_FILES['image_name']['name'];
        $directory = 'images/';
        $imageUrl = $directory.$fileName;
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        $check = getimagesize($_FILES['image_name']['tmp_name']);
        if ($check){
            if (file_exists($imageUrl)){
                die("The image is already exists. Please select another one.");
            }else{
                if ($_FILES['image_name']['size'] > 102400){
                    die("Your image size is too large. Please select within 100kb.");
                }else{
                    if ($fileType!='JPG' && $fileType!='jpg' && $fileType!='png'){
                        die("Your image type is not supported. Plaese select jpg and png format.");
                    }else{
                        move_uploaded_file($_FILES['image_name']['tmp_name'],$imageUrl);
                        $query = "INSERT INTO images(image_name) VALUES('$imageUrl')";
                        mysqli_query($link, $query);
                        echo "Image uploaded and saved successfully!!!";

                    }
                }
            }
        }else{
            die("Please select an image file. Thanks!!!");
        }

    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Image/File Upload</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
    <div>
        <label for="image">Select a Image</label>
        <input type="file" id="image" name="image_name">
    </div>
    <div>
        <input type="submit" name="btn" value="Submit">
    </div>
</form>
<hr>
<?php
        $query = "SELECT * FROM images";
        $queryResult = mysqli_query($link, $query);
?>
<table>
    <tr>
        <?php while( $image = mysqli_fetch_assoc($queryResult)){?>
        <td><img src="<?php echo $image['image_name']?>" alt="Image" width="100px" height="100px"></td>
        <?php } ?>
    </tr>
</table>
</body>
</html>