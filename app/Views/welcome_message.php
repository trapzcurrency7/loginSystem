<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Codeigniter 4 Pagination Example - Tutsmake.com</title>
  <style type="text/css">
      .pagination li{
        padding: 5px 5px 5px 5px;
        background-color: red;
        border-radius: 5px;
        margin-right: 2px;
      }
      .active{
        color: white;
        background-color: blue!important;
      }
  </style>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
   <div class="container">
    <div class="row mt-5">
       <table class="table table-bordered">
         <thead>
            <tr>
               <th>Email</th>
            </tr>
         </thead>
         <tbody>
            <?php if($users): ?>
            <?php foreach($users as $user): ?>
            <tr>
               <td><?php echo $user['email']; ?></td>
            </tr>
           <?php endforeach; ?>
           <?php endif; ?>
         </tbody>
       </table>
    </div>
      <div class="row">
          <div class="col-md-12">
            <div class="row">
              <?php if ($pager) :?>
              <?= $pager->links() ?>
              <?php endif ?>        
             </div> 
          </div>
        </div>
  </div>
</div> 
</body>
</html>
<script type="text/javascript" src="http://localhost/testPagination/public/paginate.js"></script>