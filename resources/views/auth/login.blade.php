<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ReqApp | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href=".../.../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href=".../.../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href=".../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <style>
   /* Style du modal */
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.6); /* Fond semi-transparent */
}

.center-content {
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

/* Contenu du modal */
.modal-content {
  background-color: #fefefe;
  margin: 10% auto;
  padding: 20px;
  border-radius: 10px;
  width: 70%;
  max-width: 500px;
}

/* Style du bouton de fermeture */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

/* Style des boutons */
.button-container {
  text-align: center;
  margin-top: 20px;
}

.button {
  display: inline-block;
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  border-radius: 5px;
  cursor: pointer;
  margin-right: 10px;
}

.button:hover {
  background-color: #45a049;
}

.button:last-child {
  margin-right: 0;
}

  </style>

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>Req</b>App
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="{{ route('login') }}" method="post">
      @csrf
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember_me" name="remember">
              <label for="remember_me">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

     
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="#" id="openModal" class="text-center">Create account</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>


<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Comme : </p>
    <div class="center-content">
      <button class="btn btn-block btn-info" onclick="window.location.href='account1'">Administrateur</button>
      <button class="btn btn-block btn-primary" onclick="window.location.href='account2'">Employé</button>
      <button class="btn btn-block btn-secondary" onclick="window.location.href='account'">Etudiant</button>
    </div>
    
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>

<script>
  // Récupérer le modal
var modal = document.getElementById("myModal");

// Récupérer le lien pour ouvrir le modal
var link = document.getElementById("openModal");

// Récupérer le bouton de fermeture
var span = document.getElementsByClassName("close")[0];

// Quand l'utilisateur clique sur le lien, ouvrir le modal
link.onclick = function() {
  modal.style.display = "block";
}

// Quand l'utilisateur clique sur le bouton de fermeture, fermer le modal
span.onclick = function() {
  modal.style.display = "none";
}

// Quand l'utilisateur clique en dehors du modal, fermer le modal
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

</script>

</body>
</html>
