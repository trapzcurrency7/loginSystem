
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Page</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" />
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</head>
<script type="text/javascript">
	
</script>
<body class="main-bg">
  <!-- Login Form -->
<div class="container" id="myElement">
    <div class="row justify-content-center mt-5">
      <div class="col-lg-4 col-md-6 col-sm-6 loginForm" id="loginForm" style="display: block;">
        <div class="card shadow">
            <div class="card-title text-center border-bottom">
                <h2 class="p-3"></h2>
            </div>
            <div class="card-body">
                <form id="loginView" style="display:block;" action="<?=base_url('/login')?>" method="POST">
                    <div class="notfound d-flex justify-content-center align-items-center mb-3" style="color: red;display:<?= isset($notFound)?'block!important':'none!important'?>;height: 50px;">

                        <h4><i class="fa-solid fa-circle-exclamation"></i> User not found</h4>                        
                    </div>
                    <div class="mb-4">
                        <label for="username" class="form-label">Username/Email</label>
                        <input type="text" class="form-control" id="username" name="username" />
                        <small class="text-danger"><?= isset($validation) && !empty($validation['username']) ?  $validation['username'] :null ; ?></small>
                    </div>
                    <div class="mb-4">
                        <label for="login_password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="login_password" name="password" />
                        <small class="text-danger"><?= isset($validation) && !empty($validation['password']) ?  $validation['password'] :null ; ?></small>
                         <small class="text-danger"><?= isset($invalidPassword) && !empty($invalidPassword) ?  $invalidPassword :null ; ?></small>

                    </div>
                    <?php $validation=""; ?>
                    <div class="row">
                        <div class="col-lg-4 justify-items-center">
                            <button type="Submit" class="btn btn-primary">Sign In</a>
                        </div>
                        <div class="col-lg-4">
                            <a href="javascript:void(0)" class="btn btn-warning hideShow">Sign Up</a>
                        </div>
                    </div>
                </form>
                <form id="regForm" style="display: none;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-4">
                                <label for="regusername" class="form-label">User Name</label>
                                <input type="text" class="form-control" id="regusername" name="username" />
                            </div>
                            <div class="mb-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" oninput="emailValidation()" id="email" name="email"/>
                                 <span class="validationEmails text-danger mt-2"></span>
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" oninput="strengthValidation()" name="password" id="password" required/>
                                <span class="validationErros text-danger mt-2"></span>
                            </div>
                    	</div>
              		<div class="d-grid">
	                	<a href="javascript:void(0)" class="btn btn-primary" onclick="registerUser()">Submit</a>
	                 	<a href="javascript:void(0)" class="btn btn-warning mt-2 hideShow">Login</a>
              	    </div>
            	</form>
            </div>
        </div>
      </div>
    </div>
</div>
</body>
<script type="text/javascript">
    var pageType = "login";
    var baseUrl = "<?=base_url()?>";
	var currentForm = $('#regForm').is(':visible') ? 'Registration' : 'Login';
   	$('.card-title h2').text(currentForm);
	
</script>
<script type="text/javascript" src="<?=base_url('/public/bootbox.all.js') ?>"></script>
<script type="text/javascript" src="<?=base_url('/public/bootbox.all.min.js') ?>"></script>
<script type="text/javascript" src="<?=base_url('/public/login.js')?>"></script>