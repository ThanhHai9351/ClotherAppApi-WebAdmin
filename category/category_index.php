<?php 
    include '../include/header.php';
    require '../class/db.php';
    require '../class/Category.php';

    $database= new Database();
    $conn=$database->getConnect();

    $category=new Category();
    $list=$category->getData();
?>
<?php 

?>

<?php if(count($list)>0){?>
    <h2>List Category</h2>
    <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                <?php foreach($list as $category){?>
                    <tr>
                        <td><?php echo $category->ID?></td>
                        <td><?php echo $category->NameCategory?></td>
                        <td>
                            <a href="./category_update.php?id=<?php echo $category->ID?>" class="btn btn-scbtn btn-primary m-1">Update</a>
                            <a href="./category_delete.php?id=<?php echo $category->ID?>" class="btn btn-danger m-1">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
<?php }?>

<?php include '../include/footer.php' ?>
