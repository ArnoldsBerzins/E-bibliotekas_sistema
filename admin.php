<?php 
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {

    include "db_conn.php";

    include "php/func-book.php";
    $books = get_all_books($conn);

    include "php/func-author.php";
    $authors = get_all_author($conn);

	include "php/func-category.php";
    $categories = get_all_categories($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <!-- -->
</head>
<body>
    <div class="navbar">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="admin.php">Administrators</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Veikals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pievienot grāmatu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pievienot kategoriju</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pievienot Autoru</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Iziet</a>
                    </li>
                </div>
            </div>
            </nav>
    </div>
    <?php if ($books === 0) { ?>
        empty
    <?php } else {?>
    <h4 class="mt-5">Visas grāmatas</h4>
    <table class="table table-bordered shadow">
        <thead>
            <tr>
                <th>#</th>
                <th>Tituls</th>
                <th>Autors</th>
                <th>Apraksts</th>
                <th>Kategorija</th>
                <th>Darbība</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i = 0;
            foreach($books as $book) { 
                $i++;
            ?>
            <tr>
                <td><?=$i?></td>
                <td>
                    <img width="100" src="uploads/cover/<?=$book['cover']?>">
                    <a href="uploads/files/<?=$book['file']?>">
                        <?=$book['title']?></td>
                    </a>
                <td>
                    <?php if ($authors == 0) {
						echo "Undefined";}else{ 

					    foreach ($authors as $author) {
					    	if ($author['id'] == $book['author_id']) {
					    		echo $author['name'];
					    	}
					    }
					} ?>
                </td>
                <td><?=$book['description']?></td>
                <td>
                    <?php if ($categories == 0) {
						echo "Undefined";}else{ 

					    foreach ($categories as $category) {
					    	if ($category['id'] == $book['category_id']) {
					    		echo $category['name'];
					    	}
					    }
					}
					?>
                </td>
                <td>
                    <a href="#" class="btn btn-warning">Rediģēt</a>
                    <a href="#" class="btn btn-danger">Dzēst</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php } ?>

    <?php  if ($categories == 0) { ?>
        <div class="alert alert-warning 
                    text-center p-5" 
                role="alert">
                <img src="img/empty.png" 
                    width="100">
                <br>
            Datubāzē nav nevienas kategorijas
        </div>
    <?php }else {?>
    <h4 class="mt-5">Visas kategorijas</h4>
    <table class="table table-bordered shadow">
        <thead>
            <tr>
                <th>#</th>
                <th>Kategorijas nosaukums</th>
                <th>Darbība</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $j = 0;
            foreach ($categories as $category ) {
            $j++;	
            ?>
            <tr>
                <td><?=$j?></td>
                <td><?=$category['name']?></td>
                <td>
                    <a href="edit-category.php?id=<?=$category['id']?>" 
                        class="btn btn-warning">
                        Rediģēt</a>

                    <a href="php/delete-category.php?id=<?=$category['id']?>" 
                        class="btn btn-danger">
                        Dzēst</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php } ?>

    <?php  if ($authors == 0) { ?>
        <div class="alert alert-warning 
                    text-center p-5" 
                role="alert">
                <img src="img/empty.png" 
                    width="100">
                <br>
            Datubāzē nav autoru.
        </div>
    <?php }else {?>
    <h4 class="mt-5">Visi autori</h4>
    <table class="table table-bordered shadow">
        <thead>
            <tr>
                <th>#</th>
                <th>Autora pilnais vārds</th>
                <th>Darbība</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $k = 0;
            foreach ($authors as $author ) {
            $k++;	
            ?>
            <tr>
                <td><?=$k?></td>
                <td><?=$author['name']?></td>
                <td>
                    <a href="edit-author.php?id=<?=$author['id']?>" 
                        class="btn btn-warning">
                        Rediģēt</a>

                    <a href="php/delete-author.php?id=<?=$author['id']?>" 
                        class="btn btn-danger">
                        Dzēst</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table> 
    <?php } ?>

</body>
</html>

<?php } else {
    header("Location: index.php");
    exit;
} ?>