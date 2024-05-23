<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User</title>
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" />
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

    <style type="text/css">
    	.sidebar {
      height: 100vh; /* Set sidebar height to 100% viewport height */
      padding: 20px;
    }
    nav{
    	background-color: white;
    }
    nav a{
    	padding: 2px 4px 2px 4px;
    	margin: 4px 2px 4px 2px;
    	background-color: #6c757d;
    	color: white;
    	border-radius: 5px;
    }
    </style>
</head>
<body>
    <header class="container-fluid p-3 border-bottom">
    <div class="d-flex justify-content-between">
      <h2 class="mb-0">User Dashboard</h2>
      <div class="Log-Out">
        <a class="btn btn-secondary" type="button" href="<?= base_url("/") ?>">
          logout
        </a>
      </div>
    </div>
  </header>
  <main class="container-fluid">
    <div class="row">
      <aside class="col-md-3 col-sm-4 col-12 p-3 border-end">
        <nav class="nav flex-column">
          <a class="nav-link homeView" aria-current="page" href="<?=base_url('homeView')?>">Home</a>
          <a class="nav-link editView" href="<?= base_url('/editProfileView') ?>">Edit Profile</a>
          <a class="nav-link changePasswordView" href="<?= base_url('/changePasswordView') ?>">Change Password</a>
        </nav>
      </aside>

      <section class="col-md-9 col-sm-8 col-12 p-3">
       <?php include($content)?>
      </section>
    </div>
  </main>
</body>
</html>

<script type="text/javascript">
	var baseUrl = "<?=base_url()?>";
  // console.log(baseUrl);
	$('#bdSidebar').on('click',function() {
		$('a').toggle(200);
	})

	$('#home').on('click',function() {
		location.reload();
	})
</script>
<script type="text/javascript" src="<?=base_url('/public/bootbox.all.js') ?>"></script>
<script type="text/javascript" src="<?=base_url('/public/bootbox.all.min.js') ?>"></script>