<?php 
    include '../include/header.php';
    require '../class/db.php';
    require '../class/Size.php';

    $database= new Database();
    $conn=$database->getConnect();

    $size=new Size();
    $list=$size->getData();
?>
<?php 

?>

<?php if(count($list)>0){?>
    <h2>List Size</h2>
    <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                <?php foreach($list as $size){?>
                    <tr>
                        <td><?php echo $size->ID?></td>
                        <td><?php echo $size->Size?></td>
                        <td>
                            <a href="./size_update.php?id=<?php echo $size->ID?>" class="btn btn-scbtn btn-primary m-1">Update</a>
                            <a href="./size_delete.php?id=<?php echo $size->ID?>" class="btn btn-danger m-1">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
<?php }?>

<?php include '../include/footer.php' ?>
