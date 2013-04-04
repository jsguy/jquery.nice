/*
  A "nice-like" jQuery plugin by jsguy - MIT/BSD licenced.

	It works just like jQuery's each function, except it is async, with optional callback function

		$(SELECTOR).nice(FUNCTION, [CALLBACK]);

	or

		$.nice(ARRAY, FUNCTION, [CALLBACK]);
*/
;(function($){
	$.fn.nice = function(func, cb) {
		var idx = 0,
			that = this,
			len = this.length,
			niceFunc = function(count) {
				var ele = that.get(idx);
				//	Run the function
				func.apply(ele,[idx,ele]);
				idx += 1;
				//	Recurse - clearing the rendering queue
				if(idx < len) {
					if(count >= $.fn.nice.maxCount) {
						//	Clear rendering queue
						setTimeout(function() {
							niceFunc(0);
						}, 0);
					} else {
						niceFunc(count + 1);
					}
				} else {
					//	Done
					if($.isFunction(cb)) {
						cb();
					}
				}
			};

		niceFunc(0);

		return this;
	};
	//	Maximum loops before clearing rendering queue
	$.fn.nice.maxCount = 100;
	//	Expose on main jQuery object as well
	$.nice = function(array, func, cb) {
		$(array).nice(func, cb);
	};
}(window.jQuery));
