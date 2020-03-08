<?php
include 'class/class.php';
if (!isset($_GET['eid'])) {
    move("index.php");
}
$id = $_GET['eid'];
$old_data = get_single("select *  from tbl_user where user_id = '{$id}'");
if ($old_data) {
    if (isset($_POST['edit'])) {
        $user_name = escape_string($_POST['user_name']);
        $img = "user_image";
       $upload =  upload_image_edit($img, $user_name, "uploads/", $old_data['user_image']);
        $user_image = $upload[0];
        $user_image_thumb  = $upload[1];
        $data = array(
            "user_name" => $user_name,
            "user_image" => $user_image,
            "user_image_thumb" => $user_image_thumb
        );
        updatedata($data, "tbl_user", "user_id = $id");
        move("index.php");
    }
} else {
    move("index.php");
}
?>

<html>
    <head>
        <Title>Edit User | <?php echo get_setting("project_name") ?> </Title>
    </head> 
    <body>
        <form method="post"  enctype="multipart/form-data">
            User Name :- <input type="text" value="<?php echo $old_data['user_name'] ?>" name="user_name" required=""> <br> <br>
            Image :- <input type="file" name="user_image" accept=".png,.jpg"><br> <br>

            <input type="submit" name="edit" value="Update User">
        </form>
    </body>
</html>
