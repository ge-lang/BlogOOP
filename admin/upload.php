<?php
include("includes/header.php");
include("includes/sidebar.php");
include("includes/content-top.php");

if(!$session->is_signed_in()){
    redirect('login.php');
}

$message = "";
if(isset($_POST['submit'])) {
    $photo = new Photo();
    $photo->title = $_POST['title'];
    $photo->set_file($_FILES['file']);
    if($photo->save()) {
        echo $message = "Photo uploaded sucessfully";
    } else {
        echo $message = join("<br>", $photo->errors);
    }
}
echo $message;
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="page-header">
                UPLOAD
            </h1>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">title</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <input type="file" name="file" class="form-control">
                </div>
                <input type="submit" name="submit" value="submit" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>
<?php include("includes/footer.php");  ?>