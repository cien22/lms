
<?php include('db_connect.php') ?>
<div class="col-md-12">
    <div class="row">
       <div class="card bg-success dash_total text-white col-md-3 mr-4 float-left" >
        <center>
            <h4><b>All Books</b></h4>
            <hr>
            <h3><b><?php echo $conn->query("SELECT * FROM books")->num_rows ?></b></h3>
        </center>
       </div>
       <div class="card bg-info dash_total text-white col-md-3 mr-4 float-left" >
        <center>
            <h4><b>Borrowed Books</b></h4>
            <hr>
            <h3><b><?php echo $conn->query("SELECT * FROM borrowed_books where status = 0 ")->num_rows ?></b></h3>
        </center>
       </div>
       <div class="card bg-warning dash_total text-white col-md-3 mr-4 float-left" >
        <center>
            <h4><b>Borrowers</b></h4>
            <hr>
            <h3><b><?php echo $conn->query("SELECT * FROM borrowers ")->num_rows ?></b></h3>
        </center>
       </div>
    </div>
</div>
<script>

</script>