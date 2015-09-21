<!-- BEGIN: main -->
<link rel="stylesheet" type="text/css" href="{NV_BASE_SITEURL}themes/default/css/photos_block_category_album.css" />

<div class="row" id="{BLOCK_ID}">
	<!-- BEGIN: loop_album -->
	<div class="col-md-8 col-sm-8 col-xs-12 col-lg-8">
		<div class="panel panel-default">
			<div class="panel panel-body pd4">
				<a class="images" href="{ALBUM.link}">
					<img itemprop="image" src="{ALBUM.thumb}" class="img-responsive"/>
				</a>
			</div>
			<div class="panel panel-footer pd5 view_detail">
				<a class="text-justify" href="{ALBUM.link}"><span><strong>{ALBUM.name}</strong></span></a>
				<a href="{ALBUM.link}" class="btn btn-primary pull-right"><i class="fa fa-picture-o"></i>&nbsp;{LANG.view_album}</a>
			</div>
		</div>
	</div>
	<!-- END: loop_album -->
</div>
<!-- END: main -->