<x-app-layout>

<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    

   
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



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Advanced Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Advanced Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Add Type</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
              <button class="btn btn-primary" id="duplicate-btn">Ajouter</button>
            </div>
          </div>
          <div id="form-container">
          <form class="dynamic-form" role="form" action="{{ route('addSchema') }}" method="POST">
            <!-- /.card-header -->
            <div class="card-body">
                @csrf
                <div class="row">
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Choisir un Schema</label>
                            <select name="role_id[]" class="form-control select2" style="width: 100%;">
                            @foreach($roles as $element)
                                @foreach($structs as $struct)
                                    @if($element->structure_id == $struct->id)
                                    <option value="{{ $element->id }}">{{ $element->name }} {{ $struct->name }}</option>
                                    @endif   
                                @endforeach
                            @endforeach
                                <!-- Assurez-vous de générer les options dynamiquement depuis votre contrôleur -->
                            </select>
                        </div>
                    </div>
                </div>
        
                <!-- /.row -->
            </div>
                <!-- /.card-body -->
                <input type="hidden" name="type_id" value="{{ $typeId }}">
                <input type="hidden" name="order" value="1"> <!-- Initial index -->

                
          </form>
          
        </div>
        <button id="global-submit" class="btn btn-primary">Creer</button>

        </div>
        <!-- /.card -->

    
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



<script>
    document.getElementById('duplicate-btn').addEventListener('click', function() {
        var clone = document.querySelector('.dynamic-form').cloneNode(true);
        var order = document.querySelectorAll('.dynamic-form').length + 1;
        clone.querySelector('input[name="order"]').value = order;
        document.getElementById('form-container').appendChild(clone);
    });

    document.getElementById('global-submit').addEventListener('click', function() {
        var forms = document.querySelectorAll('.dynamic-form');
        
        // Convertir NodeList en tableau pour pouvoir utiliser la méthode sort()
        var formsArray = Array.from(forms);
        
        // Trier les formulaires en fonction de leur attribut "order"
        formsArray.sort(function(a, b) {
            return a.querySelector('input[name="order"]').value - b.querySelector('input[name="order"]').value;
        });

        // Soumettre chaque formulaire dans l'ordre
        submitFormsSequentially(formsArray);
    });

    function submitFormsSequentially(forms) {
        // Créer une promesse pour soumettre chaque formulaire dans l'ordre
        var sequence = Promise.resolve();
        forms.forEach(function(form) {
            sequence = sequence.then(function() {
                return submitForm(form);
            });
        });

        sequence.then(function() {
          window.location.href = "/newType";
            console.log('Tous les formulaires ont été soumis avec succès.');
        }).catch(function(error) {
            console.error('Erreur lors de la soumission des formulaires:', error);
        });
    }

    function submitForm(form) {
        return new Promise(function(resolve, reject) {
            var formData = new FormData(form);
            var xhr = new XMLHttpRequest();
            xhr.open(form.method, form.action, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    resolve(); // Résolution de la promesse en cas de succès
                } else {
                    reject('Erreur lors de la soumission du formulaire'); // Rejet de la promesse en cas d'erreur
                }
            };
            xhr.onerror = function() {
                reject('Erreur réseau lors de la soumission du formulaire'); // Rejet de la promesse en cas d'erreur réseau
            };
            xhr.send(formData);
        });
    }
</script>

<!-- Scripts Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</x-app-layout>

