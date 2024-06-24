<?php 
    include '../include/header.php';
    require '../class/db.php';
    require '../class/Product.php';
    require '../class/Category.php';
    require '../class/Size.php';
    require '../class/Color.php';
    require '../class/ChiTietColor.php';
    require '../class/ChiTietSize.php';
    //session_destroy();
    $Name=""; $Description=""; $Image=""; $Price=""; $Quantity=""; $Category=""; $Size=""; $Color="";
    $errName=""; $errDescription=""; $errImage=""; $errPrice=""; $errQuantity=""; $errCategory=""; $errSize=""; $errColor="";
    $arrSizes= array();
    $arrColors= array();
    // session_destroy();
    
    $arrSizes = !empty($_SESSION['arrSizes']) ? unserialize($_SESSION['arrSizes']) : [];
    $arrColors = !empty($_SESSION['arrColors']) ? unserialize($_SESSION['arrColors']) : [];
    $database= new Database();
    $conn=$database->getConnect();

    $product=new Product();
    $cate=new Category();
    $color=new Color();
    $size=new Size();
    $ctSize=new ChiTietSize();
    $ctColor=new ChiTietColor();
    $listColors=$color->getData();
    $listSizes=$size->getData();
    $listCategories=$cate->getData();
    
    // echo '<pre>';
    // var_dump($arrColors);
    // echo '</pre>';
    // die();

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
    
            if(empty($Image)){
                $errImage="Require Image";
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
                $folder = '../assets/images/products/';
                $file_extension = explode('.', $Image["name"])[1];
                $file_name = $Image["name"];
                $path_file = $folder . $file_name;
                move_uploaded_file($Image["tmp_name"], $path_file);
                // insert data and get id insert
                $id=$product->insertData($Name,$Description,$Image["name"],0,$Price,$Quantity,$Category);
                foreach($arrSizes as $size){
                    $ctSize->insertData($size->ID,$id);
                }
                foreach($arrColors as $color){
                    $ctColor->insertData($color->ID,$id);
                }
                $_SESSION['arrSizes']=array();
                $_SESSION['arrColors']=array();
                header("location: ./product_index.php?insert=Successfully");
                exit;
            }
        }else if($_POST['type']=='insertColor'){
            $Color=$_POST['Color'];
            if(empty($Color)){
                $errColor="Require Color";
            }else{
                $getColor=$color->getById($Color);
                if (!in_array($getColor, $arrColors)){
                    $arrColors[]=$getColor;
                    $_SESSION['arrColors'] = serialize($arrColors);
                }
            }

        }else if($_POST['type']=='insertSize'){
            $Size=$_POST['Size'];
            if(empty($Size)){
                $errSize="Require Size";
            }else{
                $getSize=$size->getById($Size);
                if (!in_array($getSize, $arrSizes)){
                    $arrSizes[]=$getSize;
                    $_SESSION['arrSizes'] = serialize($arrSizes);
                }
                    
            }
        }else if($_POST['type']=='deleteColor'){
            $id=$_POST['Color'];
            for($i=0;$i<count($arrColors);$i++){
                if($arrColors[$i]->ID==$id){
                    unset($arrColors[$i]);
                    $arrColors = array_values($arrColors);
                    $_SESSION['arrColors'] = serialize($arrColors);
                    
                }
            }
        }else if($_POST['type']=='deleteSize'){
            $id=$_POST['Size'];
            for($i=0;$i<count($arrSizes);$i++){
                if($arrSizes[$i]->ID==$id){
                    unset($arrSizes[$i]);
                    $arrSizes = array_values($arrSizes);
                    $_SESSION['arrSizes'] = serialize($arrSizes);
                }
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
                    <input type="text" class="form-control" id="Name" placeholder="Name product" value="<?php echo $Name?>" name="Name" />
                    <?php echo "<p class='text-danger'>$errName</p>" ?>
                </td>
            </tr>
            <tr>
                <td><label class="form-label">Description</label></td>
                <td>
                    <input type="text" class="form-control" id="Description" placeholder="Description" value="<?php echo $Description?>" name="Description" />
                    <?php echo "<p class='text-danger'>$errDescription</p>" ?>
                </td>
            </tr>
            <tr>
                <td><label class="form-label">Image</label></td>
;                <td>
                    <input type="file" class="form-control" id="Image" value="<?php echo $Image?>" name="Image" />
                    <?php echo "<p class='text-danger'>$errImage</p>" ?>
                </td>
            </tr>
            <tr>
                <td><label class="form-label">Price</label></td>
                <td>
                    <input type="text" class="form-control" id="Price" placeholder="Price" value="<?php echo $Price?>" name="Price" />
                    <?php echo "<p class='text-danger'>$errPrice</p>" ?>
                </td>
            </tr>
            <tr>
                <td><label class="form-label">Quantity</label></td>
                <td>
                    <input type="text" class="form-control" id="Quantity" placeholder="Quantity" value="<?php echo $Quantity?>" name="Quantity" />
                    <?php echo "<p class='text-danger'>$errQuantity</p>" ?>
                </td>
            </tr>
            <tr>
                <td><label class="form-label">Category</label></td>
                <td>
                    <select class="form-control" id="Category" name="Category">
                        <option value="<?php echo $Category ?>">Vui lòng chọn loại</option>
                        <?php foreach($listCategories as $cate){?>
                            <option value="<?php echo $cate->ID?>"><?php echo $cate->NameCategory?></option>
                        <?php } ?>
                    </select>
                    <?php echo "<p class='text-danger'>$errCategory</p>" ?>
                </td>
            </tr>
            
        </table>
        <button type="submit" class="btn btn-scbtn btn-primary m-1">Insert</button>
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
                            <?php foreach($arrColors as $row){?>
                                <option value="<?php echo $row->ID?>"><?php echo $row->Color?></option>
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
                            <?php foreach($arrSizes as $row){?>
                                <option value="<?php echo $row->ID?>"><?php echo $row->Size?></option>
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
