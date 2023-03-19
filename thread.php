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

    // Fetch data as per category id

    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE `thread_id`='$id'";
    $result = mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($result)){
        $thread_title = $row['thread_title'];
        $thread_desc = $row['thread_desc'];
        $thread_user_id = $row['thread_user_id'];
        $sql2 = "SELECT `user_name` FROM `users` WHERE `user_id` = '$thread_user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $username = $row2['user_name'];
    }
    ?>

      <?php
        $showAlert = false;
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $comment = $_POST['comment'];

            $comment = str_replace('<','&lt;',$comment);
            $comment = str_replace('>','&gt;',$comment);

            $id = $_GET['threadid'];
            $user_id = $_SESSION['userid'];
            $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$user_id', current_timestamp())";
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
                    <strong>Success!</strong> Comment has been added.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
          }
        ?>


    <div class="container my-2 min-ht">
        <div class="alert alert-light border shadow" role="alert">
            <h4 class="alert-heading"><?php echo $thread_title ?></h4>
            <p><?php echo $thread_desc ?></p>
            <hr>
            <p class="mb-0">This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do not post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post questions. Remain respectful of other members at all times.</p>
            <p class="mb-0"><b>Posted by: <?php echo $username ?></b></p>
        </div>

        <h2>Post a Comment</h2>
        <?php
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
          echo '
          <div class="container">
              <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
                  <div class="mb-3">
                      <label for="comment" class="form-label">Type your comment</label>
                      <textarea class="form-control" name="comment" id="comment" cols="10" rows="3"></textarea>
                  </div>
                  <button type="submit" class="btn btn-info">Post a Comment</button>
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

        <h2 class="mt-4">Discussions</h2>
        <?php
            $id = $_GET['threadid'];
            $sql = "SELECT * FROM `comments` WHERE `thread_id`='$id'";
            $result = mysqli_query($conn, $sql);
            $noResult = true;
            while ($row=mysqli_fetch_assoc($result)) {
                $noResult = false;
                $comment = $row['comment_content'];
                $comment_time = $row['comment_time'];
                $comment_user_id = $row['comment_by'];
                $sql2 = "SELECT `user_name` FROM `users` WHERE `user_id` = '$comment_user_id'";
                $result2 = mysqli_query($conn, $sql2);
                $row2=mysqli_fetch_assoc($result2);
                echo '
                <div class="media mt-2">
                    <img src="partials/img/default_user.png" alt="">
                    <div class="media-body">
                        <p class="fw-bold my-0">'.$row2['user_name'].' at '.$comment_time.'</p>
                        <p>'.$comment.'</p>
                    </div>
                </div>';
            }
        ?>    

          <?php
            if($noResult){
                echo '     
                <div class="alert alert-light border shadow" role="alert">
                <h4 class="alert-heading">No Comments Found</h4>
                <p>Be the first person to comment</p>
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