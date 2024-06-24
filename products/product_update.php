<?php 
    include '../include/header.php';
    require '../class/db.php';
    require '../class/Product.php';
    require '../class/Category.php';
    require '../class/Size.php';
    require '../class/Color.php';
    require '../class/ChiTietColor.php';
    require '../class/ChiTietSize.php';

    $Name=""; $Description=""; $Image=""; $Price=""; $Quantity=""; $Category=""; $Size=""; $Color="";
    $errName=""; $errDescription=""; $errImage=""; $errPrice=""; $errQuantity=""; $errCategory=""; $errSize=""; $errColor="";
    $arrSizes= array();
    $arrColors= array();
    $database= new Database();
    $conn=$database->getConnect();

    $product=new Product();
    $cate=new Category();
    $color=new Color();
    $size=new Size();
    $ctSize=new ChiTietSize();
    $ctColor=new ChiTietColor();
    if(empty($_GET['id'])){
        header("location: ./product_index.php");
        exit;
    }
    $id=$_GET['id'];
    $product=$product->getById($id);
    $arrSizes=$ctSize->getById($id);
    $arrColors=$ctColor->getById($id);

    $listColors=$color->getData();
    $listSizes=$size->getData();
    $listCategories=$cate->getData();
    

    // insert product
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if($_POST['type']=='insertProduct'){
            $Name=$_POST['Name']; $Description=$_POST['Description']; $Image=$_FILES['Image']; $Price=$_POST['Price']; $Quantity=$_POST['Quantity']; $Category=$_POST['Category'];
            $check=true;
            if(empty($Name)){
                $errName="Require name product";
                $check=false;
            }
    
            if(empty($Description)){
                $errDescription="Require Description";
                $check=false;
            }
    
            if(empty($Price)){
                $errPrice="Require Price";
                $check=false;
            }else if(!is_numeric($Price)){
                $errPrice="Please enter number";
                $check=false;
            }
    
            if(empty($Quantity)){
                $errQuantity="Require Quantity";
                $check=false;
            }else if(!is_numeric($Quantity)){
                $errQuantity="Please enter number";
                $check=false;
            }
    
            if(empty($Category)){
                $errCategory="Require Category";
                $check=false;
            }
            
            if($check){
                // add image to folder
                $file_name=$_POST['img_old'];

                if(!empty($Image['name'])){
                    $folder = '../assets/images/products/';
                    $file_extension = explode('.', $Image["name"])[1];
                    $file_name = $Image["name"];
                    $path_file = $folder . $file_name;
                    move_uploaded_file($Image["tmp_name"], $path_file);
                }
                $product->updateData($id,$Name,$Description,$file_name,0,$Price,$Quantity,$Category);
                // update data
                
                header("location: ./product_index.php?insert=Successfully");
                exit;
            }
        }else if($_POST['type']=='insertColor'){
            $Color=$_POST['Color'];
            if(empty($Color)){
                $errColor="Require Color";
            }else{
                $ctColor->insertData($Color,$id);
                header("location: ./product_update.php?id=".$id);
                exit;
            }

        }else if($_POST['type']=='insertSize'){
            $Size=$_POST['Size'];
            if(empty($Size)){
                $errSize="Require Size";
            }else{
                $ctSize->insertData($Size,$id);
                header("location: ./product_update.php?id=".$id);
                exit;                    
            }
        }else if($_POST['type']=='deleteColor'){
            $Color=$_POST['Color'];
            if(!empty($Color)){
                $ctColor->deleteColor($Color,$id);
                header("location: ./product_update.php?id=".$id);
                exit;                
            }
        }else if($_POST['type']=='deleteSize'){
            $Size=$_POST['Size'];
            if(!empty($Size)){
                $ctSize->deleteSize($Size,$id); 
                header("location: ./product_update.php?id=".$id);
                exit;               
            }
        }
    
    }

?>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="type" value="insertProduct">
        <table class="table table-bordered">
            <tr>
                <td><label class="form-label">Name</label></td>
                <td>
                    <input type="text" class="form-control" id="Name" placeholder="Name product" value="<?php echo $product->NameProduct?>" name="Name" />
                    <?php echo "<p class='text-danger'>$errName</p>" ?>
                </td>
            </tr>
            <tr>
                <td><label class="form-label">Description</label></td>
                <td>
                    <input type="text" class="form-control" id="Description" placeholder="Description" value="<?php echo $product->Description?>" name="Description" />
                    <?php echo "<p class='text-danger'>$errDescription</p>" ?>
                </td>
            </tr>
            <tr>
                <td><label class="form-label">Image</label></td>
                <td>
                    <input type="file" class="form-control" id="Image" value="" name="Image" />
                    <input type="hidden" name="img_old" value="<?php echo $product->Image?>">
                    <?php echo "<p class='text-danger'>$errImage</p>" ?>
                </td>
            </tr>
            <tr>
                <td><label class="form-label">Price</label></td>
                <td>
                    <input type="text" class="form-control" id="Price" placeholder="Price" value="<?php echo $product->Price?>" name="Price" />
                    <?php echo "<p class='text-danger'>$errPrice</p>" ?>
                </td>
            </tr>
            <tr>
                <td><label class="form-label">Quantity</label></td>
                <td>
                    <input type="text" class="form-control" id="Quantity" placeholder="Quantity" value="<?php echo $product->Quantity?>" name="Quantity" />
                    <?php echo "<p class='text-danger'>$errQuantity</p>" ?>
                </td>
            </tr>
            <tr>
                <td><label class="form-label">Category</label></td>
                <td>
                    <select class="form-control" id="Category" name="Category">
                        <option value="<?php echo $product->CategoryID ?>">Vui lòng chọn loại</option>
                        <?php foreach($listCategories as $cate){?>
                            <option value="<?php echo $cate->ID?>"><?php echo $cate->NameCategory?></option>
                        <?php } ?>
                    </select>
                    <?php echo "<p class='text-danger'>$errCategory</p>" ?>
                </td>
            </tr>
            
        </table>
        <button type="submit" class="btn btn-scbtn btn-primary m-1">Update</button>
        <a href="./size_index.php" class="btn btn-danger m-1">Cancel</a>
    </form>
    <h2>Table color and size in product</h2>
    <table class="table table-bordered">
    <tr>
                <td><label class="form-label">Color</label></td>
                <td>
                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="type" value="deleteColor">
                        <select class="form-control" id="Color" name="Color">
                            <?php foreach($arrColors as $ctcolor){?>
                                <option value="<?php echo $ctcolor->IDColor?>"><?php echo $color->getById($ctcolor->IDColor)->Color?></option>
                            <?php } ?>
                        </select>
                        <button type="submit" class="btn btn-danger m-1">Delete</button>
                    </form>
                </td>
            </tr>
            <tr>
                <td><label class="form-label">Size</label></td>
                <td>
                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="type" value="deleteSize">
                        <select class="form-control" id="Size" name="Size">
                            <?php foreach($arrSizes as $ctsize){?>
                                <option value="<?php echo $ctsize->IDSize?>"><?php echo $size->getById($ctsize->IDSize)->Size?></option>
                            <?php } ?>
                        </select>
                        <button type="submit" class="btn btn-danger m-1">Delete</button>
                    </form>
                </td>
            </tr>
    </table>
    <h2>Insert size and color</h2>
    <div class="row">
        <div class="col-6">
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="type" value="insertSize">
                <table class="table table-bordered">
                    <tr>
                        <td><label class="form-label">NameSize</label></td>
                        <td>
                            <select class="form-control" id="Size" name="Size">
                                <?php foreach($listSizes as $size){?>
                                    <option value="<?php echo $size->ID?>"><?php echo $size->Size?></option>
                                <?php } ?>
                            </select>
                            <?php echo "<p class='text-danger'>$errSize</p>" ?>
                        </td>
                    </tr>
                </table>
                <button type="submit" class="btn btn-scbtn btn-primary m-1">Insert</button>
                <a href="./size_index.php" class="btn btn-danger m-1">Cancel</a>
            </form>
        </div>
        <div class="col-6">
        <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="type" value="insertColor">
                <table class="table table-bordered">
                    <tr>
                        <td><label class="form-label">Name Color</label></td>
                        <td>
                            <select class="form-control" id="Color" name="Color">
                                <?php foreach($listColors as $color){?>
                                    <option value="<?php echo $color->ID?>"><?php echo $color->Color?></option>
                                <?php } ?>
                            </select>
                            <?php echo "<p class='text-danger'>$errColor</p>" ?>
                        </td>
                    </tr>
                </table>
                <button type="submit" class="btn btn-scbtn btn-primary m-1">Insert</button>
                <a href="./size_index.php" class="btn btn-danger m-1">Cancel</a>
            </form>
        </div>
    </div>
    

<?php include '../include/footer.php' ?>
