<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Change Password</title>
</head>
<body>
	<div class="card">
		<div class="card-header">
			<h4>Change password</h4>
		</div>
		<div class="card-body" style="display: flex;flex-direction: column; justify-content: center;">
			<div class="col-md-6">
				<label for="oldPassowrd" class="form-label">Old Password</label>
				<input type="password" class="form-control" name="oldPassowrd" id="oldPassowrd">
				<input type="hidden"value="<?= isset($userData)&&!empty($userData)?$userData['user_id']:"" ?>" name="id" id="id">
			</div>
			<div class="col-md-6 mt-2">
				<label for="newPassword" class="form-label">New Password</label>
				<input type="password"  class="form-control" oninput="strengthValidation()" name="newPassword" id="newPassword">
				<span class="validationErros text-danger mt-2"></span>
			</div>
			<div class="col-md-6 mt-2">
				<label for="confirmPassowrd" class="form-label">Confirm Password</label>
				<input type="password" class="form-control" oninput="matchConfirmPassword()" name="confirmPassowrd" id="confirmPassowrd">
				<span class="matchErros text-danger mt-2"></span>
			</div>
			<div class="row mt-3" style="width:200px; margin-left: 1px;">
				<a href="javascript:void(0)" class="btn btn-primary" onclick="changePassword()">Change Password</a>
			</div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	var pageType = "changePasswordView";
	 $('.changePasswordView').css({'color':'white','background-color':'red'});
</script>
<script type="text/javascript" src="<?=base_url('/public/bootbox.all.js') ?>"></script>
<script type="text/javascript" src="<?=base_url('/public/bootbox.all.min.js') ?>"></script>
<script type="text/javascript" src="<?=base_url('/public/login.js')?>"></script>