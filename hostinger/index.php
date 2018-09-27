<?php
require_once 'db_connection.php';
require_once 'threeCategory.php';
require_once 'threeCategoryIterative.php';
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
</head>
<body>
    <div id="container">
        <div id="body">
            <article>

                <div class="height20"></div>
                <h4>Recursive way:</h4>
                <?php
                $res = fetchCategoryTreeList();
                foreach ($res as $r) {
                    echo $r;
                }
                ?>
                <br>
                <h4>Iterative way:</h4>
                    <?php
                    $res = iterativeTree();
                    foreach ($res as $r) {
                        echo $r;
                    }
                    ?>
                
                <div class="height10"></div>
            </article>
            <div class="height10"></div>
        </div>
    </div>

    <div class="container">
        <h2>Adding form:</h2>
        <form action="/hostinger/insert.php" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="name" class="form-control" id="name" placeholder="Enter the name" name="name">
            </div>
            <div class="form-group">
                <label for="parent">Parent number:</label>
                <input type="parent" class="form-control" id="parent" placeholder="Enter the parent number" name="parent">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>

</body>
</html>