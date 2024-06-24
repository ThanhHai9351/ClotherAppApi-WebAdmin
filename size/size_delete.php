<?php 
    include '../include/header.php';
    require '../class/db.php';
    require '../class/Size.php';

    
    $errName="";
    if(empty($_GET['id'])){
        header("location: ../home/index.php");
        exit;
    }
    $id=$_GET['id'];
    $database= new Database();
    $conn=$database->getConnect();

    $size=new Size();
    $size=$size->getById($id);

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $size->deleteData($id);
        header("location: ./size_index.php?insert=Successfully");
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
                <td><?php echo $size->Size?></td>
            </tr>
        </table>
        <button type="submit" class="btn btn-scbtn btn-primary m-1">Delete</button>
        <a href="./size_index.php" class="btn btn-danger m-1">Cancel</a>
    </form>

<?php include '../include/footer.php' ?>
