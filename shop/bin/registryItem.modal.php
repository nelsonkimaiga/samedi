<div class="modal hide fade" id="logginModal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><br /></h3>
      </div>
      <div class="modal-body">
	    <p>
			<div class="alert alert-warning">
				Please Sign In or Create An Account to create a registry
			</div><br>
			<div class="row-fluid">
				<div class="span3">
					<a href="<?=$_SESSION["page"]["home_url"]?>account/login/">
						<button class="btn btn-large btn-warning">
							Sign In
						</button>
					</a>
				</div>
				<div class="span1">
					Or
				</div>
				<div class="large-6 columns">
					<a href="<?=$_SESSION["page"]["home_url"]?>account/signup/">
						<button class="btn btn-large btn-warning">
							Create Account
						</button>
					</a>
				</div>
			</div>
		</p>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Close</a>
      </div>
</div>