




!function($) {

	// CONSTRUCTOR
	var Autocomp = function(element, options) {
	    this.$element = $(element);
	    this.options = $.extend({}, $.fn.autocomp.defaults, options);
    	this.$menu = $(this.options.menu).appendTo('body');
    	this.$itemPrototype = $(this.options.item);
    	this.$activeMenuItem = 0

    	if( typeof this.options.source == "function") {
    		this.$source = this.options.source();
    		this.sourceIsfunction = true;
    	} else {
    		this.$source = this.options.source;
    		this.sourceIsfunction = false;
    	}

		var pos = this.$element.offset();
		this.$menu.css({
			display : "block",
			top : pos.top + this.$element[0].offsetHeight,
			left: pos.left
		})

    	this.listen();
    	this.show();
    	this.shown = false;
	}


	// CLASS
	Autocomp.prototype = {

		constructor : Autocomp

	  ,	show: function() {
	  		this.shown = true;
			sa = []
			for( var key in this.$source) {
				var it = '<li><a href="javascript:void(0)">' + this.$source[key] + '</a></li>'
				this.$menu.append(it)
			}
			menu = this.$menu
			active = this.$menu.children('a').addClass('active')
		}

	  , hide: function() {
	  		this.shown = false;
	  		this.$menu.css({
	  			display : "hidden"
	  		})
	  	}

	  ,	listen: function () {
		    this.$element
		        .on('blur',     $.proxy(this.blur, this))
		        .on('keypress', $.proxy(this.keypress, this))
		        .on('keyup', 	$.proxy(this.keyup, this))
		        .on('focus', 	$.proxy(this.focus, this))


		    if ($.browser.webkit || $.browser.msie) {
		        this.$element.on('keydown', $.proxy(this.keypress, this))
		    }

		    this.$menu
		        .on('click', $.proxy(this.click, this))
		        .on('mouseenter', 'li', $.proxy(this.mouseenter, this))
	    }

	  , keyup: function() {
	  		if( this.sourceIsfunction) {
	  			this.$source = this.options.source()
	  		}
	  		switch(e.keyCode) {
		        case 40: // down arrow
		        	this.next()
		        	break;

		        case 38: // up arrow
		        	this.prev()
		          	break

		        case 9: // tab
		        case 13: // enter
		          this.select()
		          break

		        case 27: // escape
		          this.hide()
		          break

		        default:
		          this.lookup()
	      	}

		    e.stopPropagation()
		    e.preventDefault()
	  	}
	}



	// APPLY IT
	$.fn.autocomp = function (options) {
		var that = this;

	    return this.each(function () {
	      that.val('Hello World!');
	      that.data('autocomp', new Autocomp(that, options));
	   })
	}

	// DEFAULTS
	$.fn.autocomp.defaults = {
	   	  source: new Array('osmanzaaa')
	  	, items: 8
	  	, menu: '<ul class="dropdown-menu"></ul>'
	  	, item: '<li><a href="javascript:void(0)"></a></li>'
	}

  	$.fn.autocomp.Constructor = Autocomp;

}(window.jQuery);

/*

  $(function () {
    $('body').on('focus.typeahead.data-api', '[data-provide="typeahead"]', function (e) {
      var $this = $(this)
      if ($this.data('typeahead')) return
      e.preventDefault()
      $this.typeahead($this.data())
    })
  })*/
