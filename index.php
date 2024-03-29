<?php session_start();
if(!isset($_SESSION['login_id']))
  header('Location:admin.php');
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $title = isset($_GET['title']) ?$_GET['title'].' | ': '';  ?>
    <title><?php echo ucwords($title) ?>WEBAPPS LIBRARY SYSTEM</title>
    <?php include('header.php') ?>

    <style>
        #load_modal{
            background: #00000026;
            height:calc(100%);
            width:calc(100%);
            position:fixed;
            top:0;
            left:0;
            display:none;
            align-items:center;
            z-index:99999
        }
        #load_modal .card{
            margin:auto;
        }
    </style>
</head>
<body>
<header>
<?php 
    include 'db_connect.php';
    include 'topbar.php';
    include 'navbar.php';
?>
</header>

<main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">
        <?php $page = isset($_GET['page']) ? $_GET['page'] : 'home' ?>
      <?php include $page.'.php' ?>

    </div>
  </main>

  <div class="modal fade" id="delete_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="">Continue</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
  <div id="load_modal">
      <div class="card">
        <div class="card-body">
        <center><div class="spinner-border text-info" role="status">
        <span class="sr-only">Loading...</span>
      </div>  <br>
      <small><b>Please wait...</b></small>
        
      </center>
        </div>
      </div>
  </div>
</body>
<script>
window.uni_modal = function($title = '' , $url=''){
    start_load()
    $.ajax({
        url:$url,
        error:err=>{
            console.log()
            alert("An error occured")
        },
        success:function(resp){
            if(resp){
                $('#uni_modal .modal-title').html($title)
                $('#uni_modal .modal-body').html(resp)
                $('#uni_modal').modal('show')
                end_load()
            }
        }
    })
}
window.start_load = function(){
    $('#load_modal').css({'display':'flex'})
}
window.end_load = function(){
    $('#load_modal').css({'display':'none'})
}
</script>
</html>