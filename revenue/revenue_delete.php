<?php 
    include '../include/header.php';
    require '../class/db.php';
    require '../class/Receipt.php';
    require '../class/Account.php';
    require '../class/Product.php';

    
    $errName="";
    if(empty($_GET['id'])){
        header("location: ../home/index.php");
        exit;
    }
    $id=$_GET['id'];
    $database= new Database();
    $conn=$database->getConnect();

    $receipt=new Receipt();
    $product=new Product();
    $account=new Account();
    $receipt=$receipt->getById($id);

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $receipt->deleteData($id);
        header("location: ./revenue.php?insert=Successfully");
        exit;
        
    }
?>
<?php 

?>

    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="Id" value="<?php echo $id?>">
        <table class="table table-bordered">
            <tr>
                <td><label class="form-label">Name</label></td>
                <td><?php echo $account->getById($receipt->IDUser)->Name?></td>
            </tr>
            <tr>
                <td><label class="form-label">Name product</label></td>
                <td><?php echo $product->getById($receipt->IDProduct)->NameProduct?></td>
            </tr>
            <tr>
                <td><label class="form-label">Total money</label></td>
                <td>$ <?php echo $receipt->TotalMoney?></td>
            </tr>
            <tr>
                <td><label class="form-label">Paid at</label></td>
                <td><?php echo $receipt->PaidAt?></td>
            </tr>
            <tr>
                <td><label class="form-label">Color</label></td>
                <td><?php echo $receipt->Color?></td>
            </tr>
            <tr>
                <td><label class="form-label">Size</label></td>
                <td><?php echo $receipt->Size?></td>
            </tr>
        </table>
        <button type="submit" class="btn btn-scbtn btn-primary m-1">Delete</button>
        <a href="./revenue.php" class="btn btn-danger m-1">Cancel</a>
    </form>

<?php include '../include/footer.php' ?>
