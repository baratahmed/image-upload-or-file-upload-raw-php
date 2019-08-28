<?php
    if (isset($_POST['btn'])){
//        echo "<pre>";
//        print_r($_POST);
//        echo $_FILES['image_name']['tmp_name'];
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
</body>
</html>