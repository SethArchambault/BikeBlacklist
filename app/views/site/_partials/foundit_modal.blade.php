<!-- found_it_modal -->
<div class="modal fade" id="foundItModal" tabindex="-1" role="dialog" aria-labelledby="foundItModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="/email" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h1 class="modal-title" id="foundItModalLabel">I FOUND IT!</h1>
        </div>
        <div class="modal-body">
          <p>Pleae give whatever useful details you can + a way to reach you.</p>
          <input type="hidden" id="bikeIdInput" name="bike_id" value="">
          <textarea class="col-xs-12" name="content"></textarea>  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" value="Send" class="btn btn-primary">
        </div>
      </div><!-- /.modal-content -->
    </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->