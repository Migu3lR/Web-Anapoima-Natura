<?php
define('ok', 0);
define('FileNotImage', 1001);
define('FileTooLarge', 1002);
define('FileErrorFormat', 1003);
define('ErrorOnUpload', 1004);



function changeAvatar($id){
    $target_dir = "../avtr_uploads/";
    $target_file = $target_dir . $id . ".jpg";
    $code = ok;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["file"]["tmp_name"]);
        if($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $code = ok;
        } else {
            ///echo "File is not an image.";
            $code = FileNotImage;
        }
    }
    // Check file size
    if ($_FILES["file"]["size"] > 500000) {
        //echo "Sorry, your file is too large.";
        $code = FileTooLarge;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $code = FileErrorFormat;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($code == ok) {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            $code = ok;
        } else {
            $code = ErrorOnUpload;
        }
    }
    return $code;
}
?>