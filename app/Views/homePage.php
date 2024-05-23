<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Page</title>
</head>
<body>
<div class="card">
    <div class="card-header">
       <h1>Welcome, User!</h1>
        <p>This is your personalized dashboard. You can see important information and access various features here.</p>
    </div>
    <div class="card-body">

        <div class="row d-flex">
            <div class="col-md-4">
                <p>Name : <span id="name"><?= isset($userData)&& !empty($userData)?$userData['name']:"" ?></span></p>
                
            </div>
            <div class="col-md-4">
                <p>email : <span id="email"><?= isset($userData)&& !empty($userData)?$userData['user_email']:"" ?></span></p>
                
            </div>
            <div class="col-md-4">
                <p>age : <span id="age"><?= isset($userData)&& !empty($userData)?$userData['age']:"" ?></span></p>
                
            </div>
            <div class="col-md-4">
                <p>gender : <span id="gender"><?php if(isset($userData)&& !empty($userData)){
                    $gender = "";
                    if($userData['gender']=='1'){
                    $gender = "Male";

                    }elseif ($userData['gender']=='2') {
                         $gender = "Female";
                    }else{
                         $gender = $userData['gender_others'];

                    }
                    echo $gender;
                } ?></span></p>
                
            </div>
            <div class="col-md-4">
                <p>address : <span id="address"><?= isset($userData)&& !empty($userData)?$userData['address']:"" ?></span></p>
                
            </div>
        </div>
        
    </div>
</div>
</body>
</html>
<script type="text/javascript">
    var pageType = "homePage";

    $('.homeView').css({'color':'white','background-color':'red'});
    console.log(pageType)
    
</script>
     
