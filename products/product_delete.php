<?php 
    include '../include/header.php';
    require '../class/db.php';
    require '../class/Product.php';
    require '../class/Category.php';
    require '../class/Size.php';
    require '../class/Color.php';
    require '../class/ChiTietColor.php';
    require '../class/ChiTietSize.php';

    $database= new Database();
    $conn=$database->getConnect();

    $product=new Product();
    $cate=new Category();
    $color=new Color();
    $size=new Size();
    $ctSize=new ChiTietSize();
    $ctColor=new ChiTietColor();
    
    $id=$_GET['id'];
    $product=$product->getById($id);
    $ctSizeByID=$ctSize->getById($id);
    $ctColorByID=$ctColor->getById($id);


    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(!empty($_POST['id'])){
            $ctSize->deleteData($id);
            $ctColor->deleteData($id);
            $product->deleteData($id);
            header("location: ./product_index.php?delete=Successfully");
            exit;
        }
    }
?>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id?>">
        <table class="table table-bordered">
            <tr>
                <td>Image</td>
                <td><img src="../assets/images/products/<?php echo $product->Image ?>" style="width: 100px" class="card-img-top" alt=""></td>
            </tr>
            <tr>
                <td>Name product</td>
                <td><?php echo $product->NameProduct?></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><?php echo $product->Description?></td>
            </tr>
            <tr>
                <td>Star</td>
                <td><?php echo $product->Star?></td>
            </tr>
            <tr>
                <td>Price</td>
                <td>$<?php echo $product->Price?></td>
            </tr>
            <tr>
                <td>Quantity</td>
                <td><?php echo $product->Quantity?></td>
            </tr>
            <tr>
                <td>Category</td>
                <td><?php echo $cate->getById($product->CategoryID)->NameCategory?></td>
            </tr>
            <tr>
                <td>Color</td>
                <td>
                    <select class="form-control" id="Color" name="Color">
                        <?php foreach($ctColorByID as $ct){?>
                            <option value=""><?php echo $color->getById($ct->IDColor)->Color?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Size</td>
                <td>
                    <select class="form-control" id="Color" name="Color">
                        <?php foreach($ctSizeByID as $ct){?>
                            <option value=""><?php echo $size->getById($ct->IDSize)->Size?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
        </table>
        <button type="submit" class="btn btn-danger m-1">Delete</button>
    </form>
    

<?php include '../include/footer.php' ?>
