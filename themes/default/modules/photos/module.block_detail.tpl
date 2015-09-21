<!-- BEGIN: main -->
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/star-rating/jquery.rating.pack.js"></script>
<script src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/star-rating/jquery.MetaData.js" type="text/javascript"></script>
<link href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/star-rating/jquery.rating.css" type="text/css" rel="stylesheet"/>

<div class="photo-detail">
	<h2>{DATA.name}</h2>
	<div><span class="title">{LANG.album_model}: </span><span>{DATA.model}</span></div>
	<div><span class="title">{LANG.album_capturelocal}: </span><span>{DATA.capturelocal}</span></div>
	<div><span class="title">{LANG.album_capturedate}: </span><span>{DATA.capturedate}</span></div>
	<div class="news_column panel panel-default">
		<div class="panel-body">
			<form id="form3B" action="">
				<div class="h5 clearfix">
					<p>{STRINGRATING}</p>
					<!-- BEGIN data_rating -->
					<span itemscope itemtype="http://data-vocabulary.org/Review-aggregate">{LANG.rating_average}:
						<span itemprop="rating">{REVIEWCOUNT}</span> -
						<span itemprop="votes">{RATINGCOUNT}</span> {LANG.rating_count}
					</span>
					<!-- END data_rating -->
					<div style="padding: 5px;">
						<input class="hover-star" type="radio" value="1" title="{LANGSTAR.verypoor}" /><input class="hover-star" type="radio" value="2" title="{LANGSTAR.poor}" /><input class="hover-star" type="radio" value="3" title="{LANGSTAR.ok}" /><input class="hover-star" type="radio" value="4" title="{LANGSTAR.good}" /><input class="hover-star" type="radio" value="5" title="{LANGSTAR.verygood}" /><span id="hover-test" style="margin: 0 0 0 20px;">{LANGSTAR.note}</span>
					</div>
				</div>
			</form>
		<script>
		$(function() {
			var sr = 0;
			$(".hover-star").rating({
				focus: function(b, c) {
					var a = $("#hover-test");
					2 != sr && (a[0].data = a[0].data || a.html(), a.html(c.title || "value: " + b), sr = 1)
				},
				blur: function(b, c) {
					var a = $("#hover-test");
					2 != sr && ($("#hover-test").html(a[0].data || ""), sr = 1)
				},
				callback: function(b, c) {
					1 == sr && (sr = 2, $(".hover-star").rating("disable"), sendrating_album("{ALBUM_ID}", b, "{CHECKSS}"))
				}
			});
			$(".hover-star").rating("select", "{NUMBERRATING}");
			<!-- BEGIN: disablerating -->
			$(".hover-star").rating('disable');
			sr = 2;
			<!-- END: disablerating -->
		})
		</script>
		</div>
	</div>
</div>
<!-- END: main -->