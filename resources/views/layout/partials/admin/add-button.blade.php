<a id="add-btn" href="{{$url}}" class="float">
<!-- <i class="fa fa-plus fa-2x my-float"></i> -->
	<span>+</span>
	<span class="show-text">{{$btnname}}</span>
</a>


<script type="text/javascript">
	$(document).ready(function () {
		$('#add-btn').hover(function (e) {
			//$(this).addClass('expand-add');
			$('.show-text').css('opacity',1);

			$(this).css('width', (parseInt($('.show-text').width())+85) + 'px');
			/*$('.show-text').css('width','100%');*/
		}, function() {
			$('.show-text').css('opacity',0);

			$(this).css('width', '74px');
		});
	});
</script>

