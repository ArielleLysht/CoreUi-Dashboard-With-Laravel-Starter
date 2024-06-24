<x-app2-layout>
<div class="wrapper">
  <!-- Navbar -->
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="../../index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="profile">
              <i class="fas fa-sign-out-alt"></i>
              Profile
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </a>
        </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Confirmation de déconnexion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir vous déconnecter ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">Déconnexion</button>
                </form>
            </div>
        </div>
    </div>
  </div>
  <!-- Main Sidebar Container -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Nouvelle requete</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Compose</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <form role="form" action="{{ route('addReq') }}" method="POST" enctype="multipart/form-data">
         @csrf
        <div class="row">
         
          <div class="col-md-9">
            <div class="card card-primary card-outline">
              
              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group">
                    <p>
                    <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <!-- <i class="fas fa-globe"></i> ReqApp -->
                    <small id="current-date" class="float-right"></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                  @foreach($student as $user)
                    <strong>{{ $user->firstname }} {{ $user->lastname }}</strong><br>
                    {{ $user->email }}<br>
                    {{ $user->filiere }}<br>
                    {{ $user->phone }}<br>
                  @endforeach
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  
                  <address>
                    <strong>         </strong><br>
                                            <br>
                                            <br>
                                            <br>
                                             
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <!-- <b>Invoice #007612</b><br> -->
                  @foreach($post as $user)
                  <br>
                  <b>A : </b>Mr/Mme {{ $user->nom }} {{ $user->prenom }}<br>
                  @endforeach
                  @foreach($role as $office) {{ $office->name }}<br>@endforeach 
                  @foreach($struct as $office) {{ $office->name }}@endforeach <br>

                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <input type="hidden" name="type_id" value="{{ $id }}">
              <input type="hidden" name="compte_id" value="{{ $ref }}">

              <div class="row">
                  <div class="col-sm-6">
                    <!-- select -->
                    <div class="form-group">
                      <label>Niveau</label>
                      <select style="width: 15%"; name='niveau' class="form-control">
                        <option>L1</option>
                        <option>L2</option>
                        <option>L3</option>
                        <option>M1</option>
                        <option>M2</option>
                      </select>
                    </div>
                  </div>
                </div>
                <!-- Datepicker pour sélectionner l'année -->
                <div class="col-sm-6">
                    <div class="form-group">
                        <select  style="width: 15xp;" name="annee" id="year-select" class="form-control">
                            <option selected>Choisir une année...</option>
                            <!-- Générer les options pour les années -->
                            <script>
                                var startYear = 1900; // Année de départ
                                var endYear = new Date().getFullYear(); // Année actuelle
                                for (var year = endYear; year >= startYear; year--) {
                                    document.write('<option value="' + year + '">' + year + '</option>');
                                }
                            </script>
                        </select>
                    </div>
                </div>
              </div>
              <!-- this row will not appear when printing -->

              
              <div class="row no-print">
             
              </div>
            </div>
          </p>
          <label>Chargez les pièces demandées</label>
          <div class="form-group">
              @foreach($mots as $mot)
                  <div class="btn btn-default btn-file">
                      <input type="hidden" name="nom[]" value="{{ $mot }}">
                      <label for="{{ $mot }}">{{ $mot }}</label>
                      <input type="file" name="piece_jointe_{{ $loop->index }}[]" id="{{ $mot }}" accept="image/*" multiple/>
                  </div>
              @endforeach
          </div>

        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
       </div>
      </form>
               
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
    </div>

  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Summernote -->
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<!-- Page Script -->
<script>
  $(function () {
    //Add text editor
    $('#compose-textarea').summernote()
  })
</script>

<script>
    $(document).ready(function(){
        $('#year-datepicker').datepicker({
            startView: "years",
            minViewMode: "years",
            autoclose: true
        });
    });
</script>


<!-- Scripts Bootstrap -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script>
    $(document).ready(function() {
        // Fonction pour mettre à jour la date
        function updateDate() {
            var currentDate = new Date();
            var day = currentDate.getDate();
            var month = currentDate.getMonth() + 1;
            var year = currentDate.getFullYear();
            var dateString = day + '/' + month + '/' + year;
            $('#current-date').text('Date: ' + dateString);
        }

        // Mettre à jour la date initiale
        updateDate();

        // Mettre à jour la date toutes les secondes
        setInterval(updateDate, 1000);
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</x-app2-layout>
