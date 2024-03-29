<div class="col-md-12">
    <div class="row">
        <div class="col-sm-12">
            <button class="float-right btn btn-primary btn-sm" id='new_borrow'><i class="fa fa-plus"></i> Add New Borrower</button>
        </div>
    </div>
</div>
<?php 
    $borrower = $conn->query("SELECT * FROM borrowers ");
    while($row=$borrower->fetch_array()) {
        $name[$row['id']] = $row['name'];
    }
    $borrowed = $conn->query("SELECT bb.*,b.title,b.author FROM borrowed_books bb inner join books b on b.id = bb.book_id order by date(bb.date_borrowed) desc ");
    
?>
<div class="card card-cascade wider ml-1 mr-1  col-md-12" >
    <div class="card-header">
        
        <div class="card-title">
            Borrowed Books
        </div>
    </div>
    <div class="card-body">
    <table class="table table-bordered">
        <colgroup>
            <col width="5%">
            <col width="25%">
            <col width="20%">
            <col width="10%">
            <col width="10%">
            <col width="20%">
        </colgroup>
        <thead>
            <tr>
                <th>#</th>
                <th>Book</th>
                <th>Borrower</th>
                <th>Date Borrowed</th>
                <th>Returning Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i = 1;
            while($row= $borrowed->fetch_assoc()){   
                ?>
                <tr>
                    <td class="text-center"><?php echo $i++; ?></td>
                    <td>
                    <b>Book#: </b><?php echo $row['book_number']; ?><br>
                    <b>Title: </b><?php echo $row['title']; ?><br>
                     <b>Author: </b><?php echo $row['author']; ?><br>
                     <b>Return Status: </b><?php echo $row['status'] > 0 ? '<div class="badge badge-success">Returnd</div>' : '<div class="badge badge-warning">Pending</div>' ;
                        echo ($row['status'] == 0) && ( date('Ymd') > date("Ymd",strtotime($row['date_return'])) ) ? '<div class="badge badge-danger">Overdue</div>' : '' ;
                        echo ($row['status'] == 1) && ( date("Ymd",strtotime($row['date_received'])) > date("Ymd",strtotime($row['date_return'])) ) ? '<div class="badge badge-danger">Overdue</div>' : '' ;
                      ?>
                     <?php if($row['status'] == 1): ?>
                        <br>
                        <b>Date Received : </b> <?php echo date("M d,Y",strtotime($row['date_received'])); ?> 
                     <?php endif; ?>

                      </td>
                    <td><?php echo isset($name[$row['borrower_id']]) ? $name[$row['borrower_id']] : '' ; ?></td>
                    <td><?php echo date("M d,Y",strtotime($row['date_borrowed'])); ?></td>
                    <td><?php echo date("M d,Y",strtotime($row['date_return'])); ?></td>
                    <td>
                        <center>
                            <button class="btn btn-sm btn-primary ecit_borrow" data-id="<?php echo $row['id'] ?>">Edit</button>
                            <button class="btn btn-sm btn-danger remove_borrow" data-id="<?php echo $row['id'] ?>">Delete</button>
                        </center>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
</div>
<script>
$('table').dataTable();
$('#new_borrow').click(function(){
    uni_modal('Add New Borrow','manage_borrow.php')
})
$('.ecit_borrow').click(function(){
    uni_modal('Edit borrower','manage_borrow.php?id='+$(this).attr('data-id'))
})
$('.remove_borrow').click(function(){
    var _conf = confirm("Are you sure to delete this data?");
    if(_conf == true){
        $.ajax({
            url:'ajax.php?action=delete_borrow',
            method:'POST',
            data:{id:$(this).attr('data-id')},
            error:err=>{
                console.log(err)
            },
            success:function(resp){
                if(resp == 1){
                    alert('Data successfully deleted');
                    location.reload()
                }
            }
        })
    }

})
</script>