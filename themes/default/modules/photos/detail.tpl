<!-- BEGIN: main -->
<a href="#" data-src="{PHOTO.file}" class="open_modal" title="{PHOTO.name}">
<img src="{PHOTO.file}" class="img-responsive"/>
</a>

<div class="modal fade" id="idmodals">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{PHOTO.name}</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" data-show="after">
	$('.open_modal').click(function(e){
		e.preventDefault();
 		$('#idmodals .modal-body').html( '<img src="' + $(this).data('src') + '" alt="" class="img-responsive" />' );
 		$('#idmodals').modal('show');
	});
</script>
<!-- END: main -->