<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ReqApp | Read Mail</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <style>
    /* Ajoutez ici vos styles personnalisés */
    .document-card {
        margin-bottom: 20px;

        border: 1px solid #ccc;
        padding: 15px;
        border-radius: 5px;
        /* Définir la taille de l'aperçu de l'image */
        width: 100%;
        height: 200px; /* Ajustez cette valeur selon vos besoins */
        /* Centrer l'aperçu de l'image */
        display: flex;
        justify-content: center;
        align-items: center;
        /* Définir l'arrière-plan de l'aperçu de l'image */
        background-size: cover;
        background-position: center;
    }

    .image-grid {
        display: grid;  /* Enable grid layout */
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));  /* Adjust columns and min width */
    }

    .thumbnail {
        max-width: 80%;  /* Prevent images from overflowing their containers */
        height: auto;  /* Maintain aspect ratio */
        border: 1px solid #ddd;  /* Add a simple border for visual separation */
        padding: 10px;  /* Add some padding around the image */
    }

  </style>

</head>
<body class="hold-transition sidebar-mini">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
  
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


        <div class="container-fluid">
          @if (count($processedImages) > 0)
            <h2>Images</h2>
            <ul class="image-grid">
              @foreach ($processedImages as $image)
                  <li>
                      <a href="{{ $image['dataUri'] }}" data-original="{{ $image['dataUri'] }}" data-image-id="{{ $image['id'] }}">
                          <img src="{{ $image['dataUri'] }}" alt="{{ $image['nom'] }}" class="thumbnail">
                      </a>
                  </li>
              @endforeach
            </ul>
          @else
              <p>Aucune image jointe à cette requête.</p>
          @endif
        </div>

          <!-- /.col -->
        <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Read Mail</h3>

              <div class="card-tools">
                <a href="#" class="btn btn-tool" data-toggle="tooltip" title="Previous"><i class="fas fa-chevron-left"></i></a>
                <a href="#" class="btn btn-tool" data-toggle="tooltip" title="Next"><i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
            @foreach($req as $element)
                @foreach($student as $user)
                      @if($user->id==$element->user_id)
              <div class="mailbox-read-info">
                <h6>From: {{$user->firstname}} {{$user->lastname}}
                  <span class="mailbox-read-time float-right">{{$element->created_at}}</span></>
              </div>
              @endif
              
              <!-- /.mailbox-read-info -->
              <div class="mailbox-controls with-border text-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Delete">
                    <i class="far fa-trash-alt"></i></button>
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Reply">
                    <i class="fas fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Forward">
                    <i class="fas fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print">
                  <i class="fas fa-print"></i></button>
              </div>
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                <p></p>
                @foreach($type as $types)
                @if($types->id==$element->type_id)
                <p>Je suis étudiant en {{$user->filiere}} {{$element->niveau}}  et je souhaite le traitement de ma {{$types->nom}}  de l'année {{$element->annee}}. </p>
                @endif
                @endforeach
                <p>Dans l'attente d'une suite favorable, veuillez aggréer Mr/Mme, l'expression de ma plus haute considération.</p>
                <p>Merci</p>
              </div>
              <!-- /.mailbox-read-message -->
              
            </div>
            <!-- /.card-body -->
            @endforeach
            @endforeach
            <!-- /.card-footer -->
            <div class="card-footer">
              <div class="float-right">
              <form action="{{ route('valider', ['id' => $element->id]) }}" method="POST">
                @csrf
                <button class="btn-primary" type="submit"><i class="fas fa-share"></i>Valider</button>
              </form>
              <form action="{{ route('refuser', ['id' => $element->id]) }}" method="POST">
                @csrf
                <button class="btn-secondary" type="submit">Refuser</button>
              </form>
              </div>
              <button type="button" class="btn btn-default"><i class="fas fa-print"></i> Print</button>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


  <!-- /.content-wrapper -->
 


<!-- Scripts Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
  

</script>


</body>
</html>
