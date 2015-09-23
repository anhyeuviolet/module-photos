<!-- BEGIN: main -->
<div id="photo-{OP}"> 
	<div class="row" itemscope itemtype="http://schema.org/ImageObject">
		<div class="page-header pd10_0 mg0_10_10">
			<h3 class="txt20 txt_bold" itemprop="name">{CATALOG.name}</h3>
		</div>
		<div class="panel-body">
		<!-- BEGIN: loop_album -->
			<div class="col-xs-24 col-sm-12 col-md-8 album-album">
				<div class="panel panel-default">
					<div class="album-image panel-body pd5">
						<a itemprop="url" title="{ALBUM.name}" href="{ALBUM.link}">
							<img itemprop="image" class="lazy img-responsive" data-original="{ALBUM.thumb}" data-src="{ALBUM.thumb}" src="{ALBUM.thumb}"/>
						</a>
					</div>
					<div class="catalog_content panel-footer view_detail pd5">
						<div class="album-name">
							<h3><a itemprop="url" title="{ALBUM.name}" href="{ALBUM.link}"><span itemprop="name">{ALBUM.name}</span></a></h3>
							<span class="text-muted"><em class="fa fa-eye"></em>&nbsp;{ALBUM.viewed}</span>
						</div>
						<div class="clear"></div>
						<a href="{ALBUM.link}" title="{ALBUM.name}" class="btn btn-primary"><i class="fa fa-picture-o"></i>&nbsp;{LANG.view_album}</a>
						<div class="album-description" itemprop="description"> {ALBUM.description} </div>
						<span class="contentLocation" itemprop="contentLocation">{ALBUM.capturelocal}</span>
					</div>
					<meta itemprop="datePublished" content="{ALBUM.datePublished}">
				</div>
			</div>
		<!-- END: loop_album -->
		</div>
		<div class="clear"></div>
		<!-- BEGIN: social_tool -->
		<div class="col-md-24 col-sm-24 col-xs-24 pd5">
			<div class="fb-like"></div>
			<div class="fb-comments" data-href="{SELFURL}" data-width="100%" data-numposts="20" data-colorscheme="light"></div>
		</div>
		<!-- END: social_tool -->
	</div>
	<!-- BEGIN: generate_page -->
	<div id="generate_page" class="text-center">
		{GENERATE_PAGE}
	</div>
	<!-- END: generate_page -->
</div>
<script type="text/javascript">
$(function() {
    $("img.lazy").lazyload({
	effect : "fadeIn"
	});
});
</script>
<script src="{NV_BASE_SITEURL}themes/default/modules/{MODULE_FILE}/plugins/lazy/jquery.lazyload.min.js" type="text/javascript" ></script>
<!-- END: main -->