<?php
include("includes/header.php");
require_once("admin/includes/init.php");

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per_page = 8;
$items_total_count = Photo::count_all();


$paginate = new Paginate($page, $items_per_page, $items_total_count);

$sql = "SELECT * FROM photo ";
$sql .= "LIMIT {$items_per_page} ";
$sql .= "OFFSET {$paginate->offset()}";
$photos = Photo::find_this_query($sql);
?>

<div class="container-fluid">
    <h1 class="col-12 text-center py-5">Homepagina: photos</h1>
    <div class="row">
        <?php foreach ($photos as $photo): ?>
            <div class="col-3 py-3">
                <div class="card">
                    <a href="photo.php?id=<?php echo $photo->id; ?>">
                        <img src="<?php echo 'admin' . DS . $photo->picture_path(); ?>" alt=""
                             class="img-fluid card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?= $photo->title; ?></h5>
                            <p class="card-text"><?= $photo->description; ?></p>
                            <a href="photo.php?id=<?= $photo->id ?>" class="btn btn-outline-primary">Meer</a>
                        </div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="row">
        <div class="col-12 text-center">
            <ul class="pager d-inline-flex list-unstyled">
                <?php
                if ($paginate->page_total() > 1) {
                    if ($paginate->has_next()) {
                        echo "<li class='next mx-2'><a href='index.php?page={$paginate->next()}'>Next</a></li>";
                    }
                    for ($i = 1; $i <= $paginate->page_total(); $i++) {
                        if ($i == $paginate->current_page) {
                            echo "<li class='active mx-2'><a class='page-link badge-primary' href='index.php?page={$i}'> {$i} </a></li>";
                        } else {
                            echo "<li class='page-item mx-2'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
                        }
                    }
                    if ($paginate->has_previous()) {
                        echo "<li class='previous mx-2'><a href='index.php?page={$paginate->previous()}'>Previous</a></li>";
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</div>
</div></div>


<?php include("includes/footer.php"); ?>

