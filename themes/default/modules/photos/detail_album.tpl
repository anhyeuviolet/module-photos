<!-- BEGIN: main -->
<link href="{NV_BASE_SITEURL}themes/{TEMPLATE}/css/photos_multi-columns-row.css" type="text/css" rel="StyleSheet"/>
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/photos_lazyload.js" type="text/javascript" ></script>

<link href="{NV_BASE_SITEURL}themes/default/modules/{MODULE_FILE}/plugins/blueimp/bootstrap-image-gallery.min.css" type="text/css" rel="StyleSheet"/>
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/default/modules/{MODULE_FILE}/plugins/blueimp/blueimp-gallery.min.css">

<!-- BEGIN: view_grid -->
<div id="photo-content" class="rows" itemscope itemtype="http://schema.org/ImageObject">
	<a itemprop="url" href="{SELFURL}" > <span itemprop="name">{ALBUM.name}</span></a>
	<div class="photo-description" itemprop="description" > {ALBUM.description} </div>
	<span class="contentLocation" itemprop="contentLocation">{ALBUM.capturelocal}</span>
	<div id="album-gallery">
		<!-- BEGIN: loop_img -->
		<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-body pd5">
				<a href="{PHOTO.file}" title="{PHOTO.name}" data-gallery="gallery">
					<img itemprop="image" class="img-responsive center-block" src="{PHOTO.thumb}" alt="{PHOTO.description}"/>
				</a>
			</div>
			<div class="panel-footer view_detail pd5">
			<a href="{PHOTO.link_img}" class="btn btn-primary pull-right"><i class="fa fa-eye"></i>&nbsp;{LANG.view_image}</a>
			</div>
		</div>
		</div>
		<!-- END: loop_img -->
	</div>
</div>

<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
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
                        Previous
                    </button>
                    <button type="button" class="btn btn-primary next">
                        Next
                        <i class="fa fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- END: view_grid -->
<script src="{NV_BASE_SITEURL}themes/default/modules/{MODULE_FILE}/plugins/blueimp/bootstrap-image-gallery.min.js" type="text/javascript" ></script>
<script src="{NV_BASE_SITEURL}themes/default/modules/{MODULE_FILE}/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>
<!-- END: main -->