<html>
<head>
  <title>Be nice with JavaScript</title>
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="jquery.nice.js"></script>
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

<p>
	Below you'll see a progress that counts up to 100%, without crashing the browser.<br/>
	The code is inserting 4 spans in each of 30,000 DIVs, and depending on your machine/browser, it will finish slower than jQuery.each could do it, but without crashing.<br/>
	On my machine (i5 2.5Ghz "Mobile", 8GB RAM), in Chrome 29.0.1547.76 it finishes in ~ 7200ms.
</p>

<p>
Progress: <span id="progress">0%</span><span id="results"></span>
</p>

<p>
	Click the button below to run jquery.nice!<br/>
	<button type="button" id="nocrash">Click here to run test</button>
</p>

<p>
	Click the button below to either see the dreaded "Unresponsive script" error, or if your browser/machine is decent, wait while the page is seemingly frozen - you won't see any progress updates. It is running the same function, but using jQuery.each instead.<br/>
	<button type="button" id="snowcrash">Click here to crash your browser</button>
</p>

<script>
//	Poorly written JS test, enjoy.
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
	},
	//	Ensure we only run one instance
	isRunning = false,
	startTime,
	cleanUp = function(){
		$('#nocrash').removeProp('disabled');
		$('#snowcrash').removeProp('disabled');
		$('#results').html(' Inserted 120,000 spans in ' + ((new Date()).getTime() - startTime) + 'ms');
		isRunning = false;
	},
	runSilly = function(useJquery){
		if(isRunning){
			window.console && console.log('Already running, plz wait.');
			return;
		}

		startTime = (new Date()).getTime();

		$('#nocrash').prop({'disabled': 'disabled'});
		$('#snowcrash').prop({'disabled': 'disabled'});
		$('#results').html('');
		isRunning = true;

		setTimeout(function(){
			if(useJquery) {
				$('div').each(sillyDom);
				cleanUp();
			} else {
				$('div').nice(sillyDom, cleanUp);
			}
		}, 0);
	};

//	Read from the hash
var runType = window.document.location.hash;

if(runType !== "") {
	if(runType == "#snowcrash") {
		runSilly(true);
	} else {
		runSilly();
	}
}


$('#nocrash').click(function(){
	window.document.location.hash = "nocrash";
	window.document.location.reload();
});

$('#snowcrash').click(function(){
	if(confirm("Are you sure you want to crash your browser? You won't be warned again... The page will reload, and then you will see a blank screen for a bit, then 100% progress, or possibly an unresponsive warning, instead of actual progress.")) {
		window.document.location.hash = "snowcrash";
		window.document.location.reload();
	}
});

</script>

</body>
</html>
