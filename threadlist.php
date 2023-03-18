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
    include 'partials/_header.php';
    include 'partials/_dbconnect.php';

    // Fetch data as per category id

    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE `category_id`='$id'";
    $result = mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($result)){
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
    }
    ?>

        <?php
            $showAlert = false;
            $method = $_SERVER['REQUEST_METHOD'];
            if($method=='POST'){
                $id = $_GET['catid'];
                $problem_title = $_POST['problem_title'];
                $problem_desc = $_POST['problem_desc'];

                $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `thread_dt`) VALUES ('$problem_title', '$problem_desc', '$id', '0', current_timestamp())";
                $result = mysqli_query($conn, $sql);
                if($result){
                    $showAlert = true;
                }
            }
        ?>

        <?php
            if($showAlert){
                    echo '
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Problem has been added. Please wait for community to respond!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
        ?>

    <div class="container my-2 min-ht">
        <div class="alert alert-light border shadow" role="alert">
            <h4 class="alert-heading">Welcome to <?php echo $catname ?> Forums</h4>
            <p><?php echo $catdesc ?></p>
            <hr>
            <p class="mb-0">This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do not post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post questions. Remain respectful of other members at all times.</p>
        </div>

        <h2>Start a Discussion</h2>
        <?php
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        echo '
        <div class="container">
            <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Problem Title</label>
                    <input type="text" class="form-control" name="problem_title" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">Keep the problem title as short and crisp as possible.</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Elaborate Question</label>
                    <textarea class="form-control" name="problem_desc" id="exampleInputPassword1" cols="10" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-info">Submit</button>
            </form>
        </div>';
        }
        else{
            echo '
            <div class="container">
            <p class="lead">You are not logged in. Please login to be able to start discussion.</p>
            </div>';
        }
        ?>
        <h2 class="mt-4">Browse Questions</h2>
            <?php
                $id = $_GET['catid'];
                $sql = "SELECT * FROM `threads` WHERE `thread_cat_id`='$id'";
                $result = mysqli_query($conn, $sql);
                $noResults=true;
                while ($row=mysqli_fetch_assoc($result)) {
                    $noResults=false;
                    $thread_id = $row['thread_id'];
                    $thread_title = $row['thread_title'];
                    $thread_desc = $row['thread_desc'];
                    $thread_time = $row['thread_dt'];
                    echo '
                    <div class="media">
                        <img src="partials/img/default_user.png" alt="">
                        <div class="media-body">
                            <p class="fw-bold my-0">Anonymous User at '.$thread_time.'</p>
                            <h4><a class="text-dark" href="thread.php?threadid='.$thread_id.'">'.$thread_title.'</a></h4>
                            <p>'.$thread_desc.'</p>
                        </div>
                    </div>';
                }
            ?>    

            <?php
            if($noResults){
                echo '     
                <div class="alert alert-light border shadow" role="alert">
                <h4 class="alert-heading">No Questions Found</h4>
                <p>Be the first person to ask a question</p>
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