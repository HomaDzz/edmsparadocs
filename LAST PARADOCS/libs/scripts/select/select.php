<script>
$("#selectItem").change(function(){
    $('.templateblock').find('div').hide();
    var selected = $('#selectItem option:selected').attr('id');
    $('.' + selected).show();
	$('.' + 'docslist').show();
});
</script>
<script>
$("#selectItemT").change(function(){
    $('.templateblock2').find('div').hide();
    var selected = $('#selectItemT option:selected').attr('id');
    $('.' + selected).show();
});
</script>
<script>
$('select').val('');
</script>