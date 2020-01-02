<!-- Modal -->
<form method="post" action="refresh.php" id="form">
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="margin-top: 250px;">
      <div class="modal-header">
        <h4 class="modal-title">Please Enter Username to refresh</h4>
        <p id="errors"></p>
      </div>
      <div class="modal-body">
          <input type="text" class="form-control" name="ref" id="ref" required="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="reset" data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-success" id="go" disabled="" name="btn"><span class="fa fa-history"></span> Refresh</button>
      </div>
    </div>
  </div>
</div>
</form>