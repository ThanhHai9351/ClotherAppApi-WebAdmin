<?php 
    include '../include/header.php';
    require '../class/db.php';
    require '../class/Receipt.php';
    require '../class/Product.php';
    require '../class/Account.php';

    $database= new Database();
    $conn=$database->getConnect();

    $receipt=new Receipt();
    $product=new Product();
    $account=new Account();
    $list=$receipt->getData();
    $sum=0;
 ?>

<h2>Total Revenue</h2>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Name User</th>
        <th>Name Product</th>
        <th>Total Money</th>
        <th>Paid At</th>
        <th>Action</th>
    </tr>
        <?php if(count($list)>0){?>
            <?php foreach($list as $receipt){
                $sum+=$receipt->TotalMoney;
            ?>
                <tr>
                    <td><?php echo $receipt->ID?></td>
                    <td><?php echo $account->getById($receipt->IDUser)->Name?></td>
                    <td><?php echo $product->getById($receipt->IDProduct)->NameProduct?></td>
                    <td><?php echo $receipt->TotalMoney?></td>
                    <td><?php echo $receipt->PaidAt?></td>
                    <td>
                        <a href="./revenue_delete.php?id=<?php echo $receipt->ID?>" class="btn btn-danger m-1">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        <?php }?>
    </table>
    <h3>Revenue: $<?php echo $sum;?></h3>


<?php include '../include/footer.php'; ?>
