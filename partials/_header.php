<?php
include '_loginModal.php';
include '_signupModal.php';
session_start();

echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/forum">iDiscuss</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/forum">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Latest Categories
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';

            $sql = "SELECT * FROM `categories` ORDER BY category_id DESC LIMIT 5";
            $result = mysqli_query($conn, $sql);
            while($row=mysqli_fetch_assoc($result)){
              echo'
              <li><a class="dropdown-item" href="threadlist.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a></li>';
            }
          echo '</ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>
      </ul>
      <form class="d-flex" action="search.php" method="get">
        <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-info" type="submit">Search</button>
      </form>';
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        echo '
              <p class="text-light my-0 px-2 fw-bold">Welcome ' . $_SESSION['username'] . '</p>
              <a href="/forum/partials/_logout.php" class="btn btn-outline-info mx-2">Logout</a>';
      }
      else{
        echo '
            <button class="btn btn-outline-info mx-2" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>
            <button class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>';
      }
      echo '
    </div>
  </div>
</nav>';

if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=='true'){
  echo '
    <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
      <strong>Success! </strong> Now you can login.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
?>