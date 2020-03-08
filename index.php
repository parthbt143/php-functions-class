<?php
include 'class/class.php';
if (isset($_GET['did'])) {
    $id = $_GET['did'];
    if ($_GET['type'] == "soft") {
        soft_delete("tbl_user", $id);
    } else {
        hard_delete("tbl_user", " user_id = '{$id}'");
    }
    move("index.php");
}
?>

<html>
    <head>
        <Title>Display User | <?php echo get_setting("project_name") ?> </Title>
    </head> 
    <body>
    <center><h1>Display User</h1></center> 
    <a href="add.php">Add New </a>
    <center>
        <table border="1" cellpadding="5px" width="50%">
            <tr>
                <th>Sr</th>
                <th>Name</th>
                <th>Image</th>
                <th>Operation</th>
            </tr>
            <?php
            $all_users = get_all("select * from tbl_user where is_delete = '0'");

            if ($all_users > 0) {
                $sr = 0;
                foreach ($all_users as $single_user) {
                    $sr++;
                    ?>
                    <tr>
                        <td><?php echo $sr ?></td>
                        <td><?php echo $single_user['user_name'] ?></td>
                        <td><img src="<?php echo check_image(upload_url() . $single_user['user_image']) ?>" style="height:100px"></td>
                        <td> <a href="edit.php?eid=<?php echo $single_user['user_id'] ?>"> Edit </a> |<a href="index.php?type=soft&did=<?php echo $single_user['user_id'] ?>">Soft Delete </a> |  <a href="index.php?type=hard&did=<?php echo $single_user['user_id'] ?>">Hard Delete </a> </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="4"><center>No Data</center></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </center>
</body>
</html>