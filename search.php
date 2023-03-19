<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="partials/css/style.css">

    <title>iDiscuss - Forum</title>
  </head>
  <body>
    <?php 
    include 'partials/_dbconnect.php';
    include 'partials/_header.php';
    ?>

    <div class="container my-2 min-ht">
        <h2>Search results for <em>"<?php echo $_GET['search'] ?>"</em></h2>


        <?php
            $noResults = true;
            $query = $_GET['search'];
            $sql = "SELECT * FROM categories WHERE MATCH(category_name, category_description) AGAINST ('$query')";
            $result = mysqli_query($conn, $sql);
            while($row=mysqli_fetch_assoc($result)){
                $noResults = false;
                echo '
                    <div class="container">
                        <h3><a href="threadlist.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a></h3>
                        <p>'.$row['category_description'].'</p>
                    </div>';
            }

        ?>

        <?php
            $query = $_GET['search'];
            $sql = "SELECT * FROM threads WHERE MATCH(thread_title, thread_desc) AGAINST ('$query')";
            $result = mysqli_query($conn, $sql);
            while($row=mysqli_fetch_assoc($result)){
                $noResults = false;
                echo '
                    <div class="container">
                        <h3><a href="thread.php?threadid='.$row['thread_id'].'">'.$row['thread_title'].'</a></h3>
                        <p>'.$row['thread_desc'].'</p>
                    </div>';
            }

        ?>

        <?php
            $query = $_GET['search'];
            $sql = "SELECT * FROM comments WHERE MATCH(comment_content) AGAINST ('$query')";
            $result = mysqli_query($conn, $sql);
            while($row=mysqli_fetch_assoc($result)){
                $noResults = false;
                echo '
                    <div class="container">
                        <p>'.$row['comment_content'].'</p>
                    </div>';
            }

        ?>

        <?php
            if($noResults){
                $query = $_GET['search'];
                echo '
                    <div class="alert alert-light border shadow" role="alert">
                    <h4 class="alert-heading">Your search - '.$query.' - did not match any documents.</h4>
                    <p>
                    Suggestions:
                        <ul>
                            <li>Make sure that all words are spelled correctly.</li>
                            <li>Try different keywords.</li>
                            <li>Try more general keywords.</li>
                        </ul>
                    </p>
                    </div>';
            }

        ?>


    </div>

    <?php include 'partials/_footer.php' ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>