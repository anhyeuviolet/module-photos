<!-- BEGIN: main -->
<div id="photo-{OP}"> 
	<div class="row">
		<!-- BEGIN: loop_catalog -->
		<div class="panel panel-default" itemscope itemtype="http://schema.org/ImageObject">
			<div class="panel-heading">
				<h3><a href="{CATALOG.link}" class="pull-left" title="{CATALOG.name}">{CATALOG.name} ({CATALOG.num_count})</a></h3>
				<span class="pull-right">
				<!-- BEGIN: subcatloop -->
				<a href="{SUBCAT.link}" title="{SUBCAT.name}">{SUBCAT.name}</a>&nbsp;&nbsp;&nbsp;
				<!-- END: subcatloop -->
				</span>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
			<div class="panel-body pd5">
				<!-- BEGIN: loop_album -->
				<div class="col-xs-24 col-sm-12 col-md-8 album-album">
					<div class="panel panel-default">
						<div class="album-image lazyload panel-body pd5">
							<a itemprop="url" href="{ALBUM.link}">
								<img itemprop="image" class="lazy img-responsive" data-original="{ALBUM.thumb}" data-src="{ALBUM.thumb}" src="{ALBUM.thumb}"/>
							</a>
						</div>
						<div class="catalog_content panel-footer view_detail pd5">
							<div class="album-name pull-left">
								<h3>
									<span itemprop="name">{ALBUM.name}</span>
								</h3>
							</div>
							<div class="clear"></div>
							<span class="pd5 text-muted"><em class="fa fa-eye"></em>&nbsp;{ALBUM.viewed}</span>
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
		<!-- END: loop_catalog -->
	
		<!-- BEGIN: grid_album -->
		<div class="box-item" itemscope itemtype="http://schema.org/ImageObject">
			<!-- BEGIN: catalog_name -->
				<div class="category">
					<h2 itemprop="name"><a href="{CATALOG.link}" title="{CATALOG.name}">{CATALOG.name} ({CATALOG.num_album})</a></h2>
					<div class="clear"></div> 
				</div>
			<!-- END: catalog_name -->	
			<div class="row">
				<!-- BEGIN: loop_album -->
				<div class="col-xs-24 col-sm-12 col-md-8 album-album">
					<div class="panel panel-default">
						<div class="album-image lazyload panel-body pd5">
							<img itemprop="image" class="lazy img-responsive" data-src="{ALBUM.thumb}" src="{ALBUM.thumb}"/>
						</div>
						<div class="catalog_content panel-footer view_detail pd5">
							<div class="album-name pull-left">
								<h3><a itemprop="url" href="{ALBUM.link}"> <span itemprop="name">{ALBUM.name}</span></a></h3>
								<span class="pd5 text-muted"><em class="fa fa-eye"></em>&nbsp;{ALBUM.viewed}</span>
							</div>
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
		<!-- END: grid_album -->
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