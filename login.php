<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/register_login_form.css">
  </head>
  <body style="background-image:url(assets/img/loginbg.jpg);" class="bg-image">

  <?php 
 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signIn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email exists  
    $sql = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $sql->bind_param("s", $email);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['email'] = $row['email'];
            header("Location: index.php");
            exit();
        } else {
            echo "Incorrect Email or Password";
        }
    } else {
        echo "Incorrect Email or Password";
    }

    $sql->close();
}

 
?>



    <section class="vh-100 gradient-custom">
      <!-- sign in form start -->
      <div class="container py-5" id="sign_form" >
        <div class="row d-flex justify-content-center align-items-center">
          <div class="col-7 col-md-6 col-lg-5 col-xl-4">
            <div class="card text-white" style="border-radius: 1rem; background: rgb(84, 99, 99);">
              <div class="card-body p-5 text-center">
                <form action="assets/php/register.php" method="post">
                <div class="mb-md-5 mt-md-4 pb-2">
                  <h2 class="fw-bold text-uppercase py-4">Sign in</h2>
                  <div class="form-outline mb-3">
                    <input type="text" class="form-control" />
                    <label class="form-label">Your Name</label>
                  </div>
                  <div class="form-outline mb-3">
                    <input type="password" class="form-control" />
                    <label class="form-label">Password</label>
                  </div>
                  <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-outline-light btn-lg px-5" id="signIn">Sign in</button>
                  </div>
                  <a class="text-info" href="#!">Forgot password?</a>
                  <h1 class="fs-6 py-4">Don't have an account? <a href="#" id="show_sign_up" class="text-danger">Sign Up</a></h1>
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- sign in form end -->
      <!-- sign up form start -->
      <div class="container py-5" id="sign_up_form" style="display: none;">
        <div class="row d-flex justify-content-center align-items-center">
          <div class="col-7 col-md-6 col-lg-5 col-xl-4 pt-5">
            <div class="card text-white" style="border-radius: 1rem; background: rgb(84, 99, 99);">
              <div class="card-body p-5 text-center">
                <form action="assets/php/register.php" method="post">
                  <h2 class="fw-bold text-uppercase py-4">Register</h2>
                  <div class="form-outline mb-3">
                    <input type="text" id="name" class="form-control" />
                    <label class="form-label">Your Name</label>
                  </div>
                  <div class="form-outline mb-3">
                    <input type="email" class="form-control" id="email"/>
                    <label class="form-label">Your Email</label>
                  </div>
                  <div class="form-outline mb-3">
                    <input type="password" class="form-control" id="password" />
                    <label class="form-label">Password</label>
                  </div>
                  <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-outline-light btn-lg px-5" id="sign_up">Sign Up</button>
                  </div>
                  <h1 class="fs-6 py-4">Already have an account? <a href="#" id="show_sign_in" class="text-danger">Sign In</a></h1>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- sign up form end -->
    </section>
    <script src="assets/js/login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>