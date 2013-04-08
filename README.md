jqnice
======

jQuery nice plugin - sort of a little like the "nice" command, (http://en.wikipedia.org/wiki/Nice_(Unix)), (well, the overall idea is the same), but for jQuery iteration instead.

Usage: (just like jQuery .each, only slower, and probably won't hang your browser if you do something really silly (DOM intensive)

    $('div').nice(function(idx,ele) {
      for(var x = 0; x < 1000; x += 1) {
    		$(this).find('span').html('<div>Updated DOM</div>');
    	}
    });

Imagine: you had a page with a giant DOM - the above would allow you to run without getting the dreaded "Unresponsive script" message... well, in most cases anyway - you can still do things to break it if you try - ie: each 100 iterations takes more than the amount of seconds before a timeout occurs.

Note: you can also set the iteration count if 100 is not enough before it clears the rendering queue, for example:

    $.fn.nice.maxCount = 50;

Will clear the rendering queue when you reach 50 iterations
