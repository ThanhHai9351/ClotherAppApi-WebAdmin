<?php 
    include '../include/header.php';
    require '../class/db.php';
    require '../class/Size.php';

    
    $errName="";
    if(empty($_GET['id'])){
        header("location: ./index.php");
        exit;
    }
    $id=$_GET['id'];
    $database= new Database();
    $conn=$database->getConnect();

    $size=new Size();
    $size=$size->getById($id);

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if(empty($_POST['Name'])){
            $errName="Require name size";
        }
        else{
            $size->updateData($id,$_POST['Name']);
            header("location: ./size_index.php?insert=Successfully");
            exit;
        }
    }
?>
<?php 

?>

    <form method="post" enctype="multipart/form-data">
        <table class="table table-bordered">
            <tr>
                <td><label class="form-label">Name</label></td>
                <td>
                    <input type="text" class="form-control" id="Name" placeholder="Name size" value="<?php echo $size->Size?>" name="Name" />
                    <?php echo "<p class='text-danger'>$errName</p>" ?>
                </td>
            </tr>
        </table>
        <button type="submit" class="btn btn-scbtn btn-primary m-1">Update</button>
        <a href="./size_index.php" class="btn btn-danger m-1">Cancel</a>
    </form>

<?php include '../include/footer.php' ?>
