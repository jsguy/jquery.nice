<html>
<head>
  <title>Be nice with JavaScript</title>
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="../jquerynice/jquery.nice-0.0.1.js"></script>
	<style>
		.hide	{ display: none; }
	</style>
</head>
<body>

<?php
$num = 30000;
for($i = 0; $i < $num; $i += 1) {
	print "<div class='hide'><span data-number='<?php print $1; ?>'><a href='#'>Test</a></span></div>";
}
?>

<div id="progress">0%</div>

<script>
var progress = function(idx){
		var total = <?php print $num; ?>,
			pct = parseInt((idx/total)*100, 10);
		$('#progress').html(pct + "%");
	},
	//	Do something silly with the DOM
	sillyDom = function(idx,ele) {
		for(var x = 0; x < 4; x += 1) {
			$(this).find('span').html('<span>Updated DOM</span>');
		}
		progress(idx + 1);
	};

//	WARNING: might crash your browser!
//$('div').each(sillyDom);

//	Works!
$('div').nice(sillyDom);

</script>

</body>
</html>
