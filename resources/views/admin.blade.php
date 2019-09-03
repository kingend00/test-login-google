<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
 <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>SB Admin - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.html">Infomation Admin</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar -->
    <ul class="d-none d-md-inline-block ml-auto mr-0 mr-md-3 form-inline my-2 my-md-0 li-del-node">
      <li class="nav-item dropdown no-arrow mx-1">
        <i class="fas fa-user icon-color"></i>
        <a href="#" class="change-color-a">{{ isset(Auth::user()->email) ? Auth::user()->email : "" }}</a>
      </li>
      <li class="nav-item dropdown no-arrow mx-1">
        <i class="fas fa-sign-out-alt icon-color"></i>
          <a href="{{ route('logout') }}"
              onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();" class="change-color-a">
              Logout
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
      </li>
    </ul>
  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.html">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
    </ul>

    <div id="content-wrapper">
			<div class="container">
        <div class="img-avatar">
          <h3>Avatar</h3>
            <img src="image/{{ Auth::user()->avatar }}" width="150px" height="150px" class="avatar">
        </div>
    <div class="card card-register mx-auto mt-5">
      <div class="message-container">
        <div class="message"></div>
      </div>
      <div class="card-header"><h2>Infomation an Account</h2></div>
      <div class="card-body">
        <form id="formUpdate" method="POST" enctype="multipart/form-data">
        	<input type="hidden" id="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="fullName" name="fullName" class="form-control" placeholder="First name" value="{{isset(Auth::user()->fullname) ? Auth::user()->fullname : '' }}" required="required" autofocus="autofocus">
                  <label for="fullName">Full name</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required="required" value="{{isset(Auth::user()->email) ? Auth::user()->email : '' }}" readonly="readonly">
              <label for="email">Email</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="phone" name="phone" value="{{isset(Auth::user()->phone) ? Auth::user()->phone : '' }}" class="form-control" placeholder="Password" required="required">
                  <label for="phone">Phone number</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="avatar" name="avatar" class="form-control">
                  <label for="avatar">Avatar</label>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" >Update</button>
        </form>
      </div>
    </div>
  </div>
      
    </div>
   </div>

      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Hydraw - ROG Team</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
      });
		$('#formUpdate').on('submit',function(e){
			e.preventDefault();
			$.ajax({
				type:'POST',
				url:'{{url("admin/edit")}}',
				data:new FormData(this),
        processData:false,
        contentType: false,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				success:function(data){
          if(Array.isArray(data))
          {
            $('.avatar').attr('src',"image/"+data[0].avatar);
            $('#phone').val(data[0].phone);
            $('#fullName').val(data[0].fullname);
            $('.message').append('<div class="alert alert-success error-alert maxping"><h4>Successfully</h4></div>').fadeOut(6000);
            $('.message-container').append("<div class = 'message'></div>");

          }
          else
          {
            $('.message').append('<div class="alert alert-danger error-alert maxping"><h4>'+data+'</h4></div>').fadeOut(6000);
            $('.message-container').append("<div class = 'message'></div>");
          }
          
				},
				error:function(er){
					console.log(er);
				}
			});
		});
	});
</script>

</body>

</html>
