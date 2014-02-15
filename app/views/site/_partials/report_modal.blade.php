
<!-- reportModal -->
<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h1 class="modal-title" id="reportModalLabel">My Bike is Missing!</h1>
      </div>
      <div class="modal-body">
	    <p>First off - I'm really sorry your bike is missing.  This sucks. But don't despair. Detroit will help you get it back!</p>
	    
        {{ Form::open(['route' => 'site.store', 'files' => true]) }}

	    <div class="form-group">
		    <div class="input-group input-group-lg">
				<label for="photo" class="input-group-addon">Photo</label>
			    <div class="form-control">
					<input type="text" name="subfile" id="subfile">
					<a class="btn" id="subbutton">Browse</a>
				</div>
			</div>
		    <p class="help-block">Upload the clearest photo of your bike</p>
	    </div>
	    {{ Form::file('photo', ['id' => 'photo', 'style' => 'display:none;']) }}

	    
	    <div class="form-group">
		    <div class="input-group input-group-lg">
				<span class="input-group-addon">Description</span>
                {{ Form::textarea('description', '',  ['class' => 'form-control', 'maxlength' => 140,'placeholder' => 'It has a coaster brake.']) }}
			</div>
		    <p class="help-block">What else identifies your bike?</p>
	    </div>
	    <div class="form-group">
		    <div id="lost_date_div" class="input-group input-group-lg">
				<span class="input-group-addon">Date</span>
                {{ Form::text('lost_date', '',  ['id' => 'lost_date', 'class' => 'form-control', 'placeholder' => 'mm/dd/yyyy']) }}
			</div>
		    <p class="help-block">When did this happen?</p>
		</div>

	    <div class="form-group">
		    <div class="input-group input-group-lg">
				<span class="input-group-addon">Email</span>
                {{ Form::text('email', '',  ['class' => 'form-control', 'placeholder' => 'yourname@probablygmail.com']) }}
		    </div>
		    <p class="help-block">You'll only get an email if someone finds your bike.</p>
	    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      
        {{ Form::submit('Send', array('class' => 'btn btn-primary')) }}
      </div>
      {{ Form::close() }}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->