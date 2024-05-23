<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit profile</title>
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" />
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<div class="content">
			
			<div class="card">
				<div class="card-header">
					<h4>Edit Profile</h4>
				</div>
				<div class="card-body">
					<form id="editForm">
						<div class="row">
							<div class="col-md-6">
								<input type="hidden"value="<?= isset($userData)&&!empty($userData)?$userData['user_id']:"" ?>" name="id" id="id">
								<label for="username" class="form-label">Username</label>
								<input type="text" class="form-control" value="<?= isset($userData)&&!empty($userData)?$userData['user_name']:"" ?>" name="username" id="username">
							</div>
							<div class="col-md-6">
								<label for="email" class="form-label">Email</label>
								<input type="email" class="form-control" value="<?= isset($userData)&&!empty($userData)?$userData['user_email']:"" ?>" name="email" id="email">
							</div>
							<div class="col-md-6">
								<label for="name" class="form-label mt-2">Name</label>
								<input type="text" class="form-control" value="<?= isset($userData)&&!empty($userData)?$userData['name']:"" ?>" name="name" id="name">
							</div>
							<div class="col-md-6">
								<label for="age" class="form-label mt-2">Age</label>
								<input type="number" class="form-control" value="<?= isset($userData)&&!empty($userData)?$userData['age']:"" ?>" name="age" id="age">
							</div>
							<div class="col-md-6">
								<label for="gender" class="form-label mt-2">Gender</label>
								<select class="form-select" name="gender" id="gender" onchange="">
									<option value="0">Select</option>
									<option value="1" <?=isset($userData)&& $userData['gender']==1?"selected":""?>>Male</option>
									<option value="2" <?=isset($userData)&& $userData['gender']==2?"selected":""?>>Female</option>
									<option value="3" <?=isset($userData)&& $userData['gender']==3?"selected":""?>>Others</option>
								</select>
							</div>
							<div class="col-md-6">
								<label for="address" class="form-label mt-2">Address</label>
								<input type="text" class="form-control" value="<?= isset($userData)&&!empty($userData)?$userData['address']:"" ?>" name="address" id="address">
							</div>
							<div class="col-md-6 others" style="display: <?=isset($userData)&& $userData['gender']==3?"block":"none"?>;">
								<label for="others" class="form-label mt-2">Others</label>
								<input type="text" class="form-control" name="others" value="<?= isset($userData)&&!empty($userData)?$userData['gender_others']:"" ?>" id="others">
							</div>
						</div>
					</form>	
					<div class="row mt-2">
						<a href="javascript:void(0)" class="btn btn-primary" onclick="updateDetails()" style="width:60px;margin-left: 10px!important;">Save</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	var pageType = "editView";
	 $('.editView').css({'color':'white','background-color':'red'});
	$('#gender').on('change',function() {
		var value =$('#gender').val();

		if(value==3){
			$('.others').toggle();
		}else{
			$('.others').hide();
		}
	})
	
</script>
<script type="text/javascript" src="<?=base_url('/public/bootbox.all.js') ?>"></script>
<script type="text/javascript" src="<?=base_url('/public/bootbox.all.min.js') ?>"></script>
<script type="text/javascript" src="<?=base_url('/public/login.js')?>"></script>