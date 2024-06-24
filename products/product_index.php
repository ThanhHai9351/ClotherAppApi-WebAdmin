<?php 
    include '../include/header.php';
    require '../class/db.php';
    require '../class/Product.php';

    $database= new Database();
    $conn=$database->getConnect();

    $product=new Product();
    $list=$product->getData();
    // echo '<pre>';
    // var_dump($list);
    // echo '</pre>';
?>
<?php 

?>

<?php if(count($list)>0){?>
    <h2>List product</h2>
    <table class="table table-bordered">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
                <?php foreach($list as $product){?>
                    <tr>
                        <td>
                            <img src="../assets/images/products/<?php echo $product->Image ?>" style="height: 50px" class="card-img-top" alt="">
                        </td>
                        <td><a href="./product_detail.php?id=<?php echo $product->ID?>"><?php echo $product->NameProduct?></a></td>
                        <td><?php echo $product->Price?></td>
                        <td><?php echo $product->Quantity?></td>
                        <td><?php echo $product->CategoryID?></td>
                        <td>
                            <a href="./product_update.php?id=<?php echo $product->ID?>" class="btn btn-scbtn btn-primary m-1">Update</a>
                            <a href="./product_delete.php?id=<?php echo $product->ID?>" class="btn btn-danger m-1">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
<?php }?>

<?php include '../include/footer.php' ?>
