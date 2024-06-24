<?php 
    include '../include/header.php';
    require '../class/db.php';
    require '../class/Color.php';

    $database= new Database();
    $conn=$database->getConnect();

    $color=new Color();
    $list=$color->getData();
?>
<?php 

?>

<?php if(count($list)>0){?>
    <h2>List Color</h2>
    <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                <?php foreach($list as $color){?>
                    <tr>
                        <td><?php echo $color->ID?></td>
                        <td><?php echo $color->Color?></td>
                        <td>
                            <a href="./color_update.php?id=<?php echo $color->ID?>" class="btn btn-scbtn btn-primary m-1">Update</a>
                            <a href="./color_delete.php?id=<?php echo $color->ID?>" class="btn btn-danger m-1">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
<?php }?>

<?php include '../include/footer.php' ?>
