<?php 
    include '../include/header.php';
    require '../class/db.php';
    require '../class/Color.php';

    
    $errName=""; $name="";
    $database= new Database();
    $conn=$database->getConnect();

    $color=new Color();

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if(empty($_POST['Name'])){
            $errName="Require name color";
        }
        else{
            $color->insertData($_POST['Name']);
            header("location: ./color_index.php?insert=Successfully");
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
                    <input type="text" class="form-control" id="Name" placeholder="Name color" value="<?php echo $name?>" name="Name" />
                    <?php echo "<p class='text-danger'>$errName</p>" ?>
                </td>
            </tr>
        </table>
        <button type="submit" class="btn btn-scbtn btn-primary m-1">Insert</button>
        <a href="./color_index.php" class="btn btn-danger m-1">Cancel</a>
    </form>

<?php include '../include/footer.php' ?>
