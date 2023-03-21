<!doctype html>
<html lang="en">

<head>
  <title>iDiscuss - Forum</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="partials/css/style.css">

</head>

<body>
 <?php include 'partials/_dbconnect.php' ?>
 <?php include 'partials/_header.php' ?>

 <?php
  $showAlert = false;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $fullname = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $sql ="INSERT INTO `contact` (`fullname`, `email`, `subject`, `message`, `contact_dt`) VALUES ('$fullname', '$email', '$subject', '$message', current_timestamp());";
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
          <strong>Success!</strong> Your contact details has been submitted.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
      }
  ?>
 <div class="d-flex justify-space-between sty-contact border my-4">
    <div class="container mb-5 mt-5">
      <h4 class="mt-4 mb-4 fw-bold ml-1">Contact Us</h4>
      <form class="row g-3 ml-2 mr-1" action="/forum/contact.php" method="post">
        <div class="col-md-6">
          <label for="name" class="form-label fw-bold">FULL NAME</label>
          <input type="text" class="form-control" name="name" id="name" placeholder="Name">
        </div>
        <div class="col-md-6">
          <label for="email" class="form-label fw-bold">EMAIL ADDRESS</label>
          <input type="email" class="form-control" name="email" id="email" placeholder="Email">
        </div>
        <div class="col-12">
          <label for="subject" class="form-label fw-bold">SUBJECT</label>
          <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
        </div>
        <div class="col-12">
          <label for="message" class="form-label fw-bold">MESSAGE</label>
          <textarea class="form-control" name="message" id="message" cols="30" rows="4" placeholder="Message"></textarea>
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-info">Send Message</button>
        </div>
      </form>
    </div>

    <div class="container sty-map">
    <iframe class="my-0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30765427.21648845!2d61.019120525834346!3d19.731973045852424!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30635ff06b92b791%3A0xd78c4fa1854213a6!2sIndia!5e0!3m2!1sen!2sin!4v1679394583714!5m2!1sen!2sin" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>

 <?php include 'partials/_footer.php' ?>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>