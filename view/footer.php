<script>
	$('.pag a').on('click', function(e){
		e.preventDefault;
		var new_page = $(this).attr('data-page');
		$('#page').val(new_page);
		$('#our-form').submit();
	});
</script>
</body>
</html>
