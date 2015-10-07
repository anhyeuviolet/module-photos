<!-- BEGIN: main -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/default/modules/{MODULE_FILE}/plugins/blueimp/blueimp-gallery.min.css">

<div class="row">
	<div class="col-md-24 col-sm-24 col-xs-24">
		<div class="page-header pd10_0 mg0_10_10">
			<h3 class="txt20 txt_bold"><span class="pd5">{PHOTO.name}</span></h3>
			<span class="pd5 text-muted"><em class="fa fa-eye"></em> {PHOTO.viewed}</span>
		</div>
	</div>
	
	<div id="view_image_{PHOTO.row_id}" class="col-md-24 col-sm-24 col-xs-24">
		<!-- BEGIN: pre -->
		<a href="{PREV.link}" class="arrow_left" title="{PREV.name}"><i class="fa fa-chevron-circle-left fa-3x"></i></a>
		<!-- END: pre -->
		<div class="col-md-24 col-sm-24 col-xs-24">
			<div id="photo-{PHOTO.row_id}">
				<a href="{PHOTO.file}" title="{PHOTO.name}" data-gallery="gallery">
					<img src="{PHOTO.file}" class="img-thumbnail"/>
				</a>
			</div>	
		</div>
		<!-- BEGIN: next -->
		<a href="{NEXT.link}" class="arrow_right" title="{NEXT.name}"><i class="fa fa-chevron-circle-right fa-3x"></i></a>
		<!-- END: next -->
	</div>
	<!-- BEGIN: social_tool -->
	<div class="col-md-24 col-sm-24 col-xs-24 pd5">
		<div class="fb-like"></div>
		<div class="fb-comments" data-href="{SELFURL}" data-width="100%" data-numposts="20" data-colorscheme="light"></div>
	</div>
	<!-- END: social_tool -->
	<div id="blueimp-gallery" class="blueimp-gallery">
		<div class="slides"></div>
		<h3 class="title"></h3>
		<a class="prev">‹</a>
		<a class="next">›</a>
		<a class="close">×</a>
		<a class="play-pause"></a>
		<ol class="indicator"></ol>
		<div class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" aria-hidden="true">&times;</button>
						<h4 class="modal-title"></h4>
					</div>
					<div class="modal-body next"></div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left prev">
							<i class="fa fa-chevron-left"></i>
							{LANG.view_previous}
						</button>
						<button type="button" class="btn btn-primary next">
							{LANG.view_next}
							<i class="fa fa-chevron-right"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="{NV_BASE_SITEURL}themes/default/modules/{MODULE_FILE}/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>
<script type="text/javascript" data-show="after">
$(function(){
    $('html, body').animate({
        scrollTop: $('#photo-{PHOTO.row_id}').offset().top
    }, 1500);
    return false;
});
</script>
<!-- END: main -->