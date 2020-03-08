<?php
include 'class/class.php';
if (isset($_POST['add_user'])) {
    $user_name = escape_string($_POST['user_name']);
    $img = "user_image";
    $thumb = $_POST['thumb'];
    $upload = upload_image($img, $user_name, "uploads/", $thumb);
    $user_image = $upload[0];
    $user_image_thumb = $upload[1];
    $data = array(
        "user_name" => $user_name,
        "user_image" => $user_image,
        "user_image_thumb" => $user_image_thumb
    );
    insertdata($data, "tbl_user");
    move("index.php");  
}
?>

<html>
    <head>
        <Title>Insert User | <?php echo get_setting("project_name") ?> </Title>
    </head> 
    <body>
        <form method="post"  enctype="multipart/form-data">
            User Name :- <input type="text" name="user_name" required=""> <br> <br>
            Image :- <input type="file" name="user_image" accept=".png,.jpg"><br> <br>
            Upload Thumb :- <select name="thumb">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select> <br> <br>
            <input type="submit" name="add_user" value="Add User">
        </form>
    </body>
</html>
