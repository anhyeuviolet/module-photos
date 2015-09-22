<!-- BEGIN: main -->
<div id="photo-{OP}"> 
	<div class="fixed">
		<div id="photo-album">
			<div class="box-item multi-columns-row" itemscope itemtype="http://schema.org/ImageObject">
				<div class="row">
					<div class="col-md-24">
						<h2 itemprop="name"><a href="{CATALOG.link}" title="{CATALOG.name}">{CATALOG.name} ({CATALOG.num_album})</a></h2>
					</div>
				</div>
				<div class="row">
					<!-- BEGIN: loop_album -->
					<div class="col-xs-24 col-sm-12 col-md-8 album-album">
						<div class="panel panel-default">
							<div class="album-image lazyload panel-body pd5">
								<img itemprop="image" class="lazy img-responsive" data-original="{ALBUM.thumb}" data-src="{ALBUM.thumb}" src="{ALBUM.thumb}"/>
							</div>
							<div class="catalog_content panel-footer view_detail pd5">
								<div class="album-name pull-left">
									<h3><a itemprop="url" href="{ALBUM.link}"> <span itemprop="name">{ALBUM.name}</span></a></h3>
								</div>
								<div class="clear"></div>
								<a href="{ALBUM.link}" class="btn btn-primary pull-right"><i class="fa fa-picture-o"></i>&nbsp;{LANG.view_album}</a>
								<div class="album-description" itemprop="description"> {ALBUM.description} </div>
								<span class="contentLocation" itemprop="contentLocation">{ALBUM.capturelocal}</span>
							</div>
							<meta itemprop="datePublished" content="{ALBUM.datePublished}">
						</div>
					</div>
					<!-- END: loop_album -->
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<!-- BEGIN: generate_page -->
		<div id="generate_page" class="text-center">
			{GENERATE_PAGE}
		</div>
		<!-- END: generate_page -->
	</div> 
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