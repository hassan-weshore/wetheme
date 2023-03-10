( function( $ ) {

	/**
	* Search widget JS
	*/

	var WidgethfeSearchButton = function( $scope, $ ){

		if ( 'undefined' == typeof $scope )
			return;

			var $input = $scope.find( "input.coherence-core-search-form__input" );
			var $clear = $scope.find( "button#clear" );
			var $clear_with_button = $scope.find( "button#clear-with-button" );
			var $search_button = $scope.find( ".coherence-core-search-submit" );
			var $toggle_search = $scope.find( ".coherence-core-search-icon-toggle input" );

		$scope.find( '.coherence-core-search-icon-toggle' ).on( 'click', function( ){
			$scope.find( ".coherence-core-search-form__input" ).trigger( 'focus' );						
		});	
		
		$scope.find( ".coherence-core-search-form__input" ).on( 'focus', function(){
			$scope.find( ".coherence-core-search-button-wrapper" ).addClass( "coherence-core-input-focus" );
		});

		$scope.find( ".coherence-core-search-form__input" ).blur( function() {
			$scope.find( ".coherence-core-search-button-wrapper" ).removeClass( "coherence-core-input-focus" );
		});
  		   

		$search_button.on( 'touchstart click', function(){
			$input.submit();
		});

		$('.coherence-core-search-type-popup .close').on( 'click', function(){
			$('.coherence-core-search-type-popup').removeClass('show');
		});

		$('.coherence-core-search-type-popup .coherence-core-show-popup').on('click' , function(){
			$('.coherence-core-search-type-popup').addClass('show');
		});

		$toggle_search.css( 'padding-right', $toggle_search.next().outerWidth() + 'px' );

	
		$input.on( 'keyup', function(){
			$clear.style = (this.value.length) ? $clear.css('visibility','visible'): $clear.css('visibility','hidden');
			$clear_with_button.style = (this.value.length) ? $clear_with_button.css('visibility','visible'): $clear_with_button.css('visibility','hidden');
			$clear_with_button.css( 'right', $search_button.outerWidth() + 'px' );
		});

		$clear.on("click",function(){
			this.style = $clear.css('visibility','hidden');
			$input.value = "";
		});
		$clear_with_button.on("click",function(){
			this.style = $clear_with_button.css('visibility','hidden');
			$input.value = "";
		});
		
	};
		/**
	 * Nav Menu handler Function.
	 *
	 */
	var WidgethfeNavMenuHandler = function( $scope, $ ) {
		if ( 'undefined' == typeof $scope )
			return;
		
		var id = $scope.data( 'id' );
		var wrapper = $scope.find('.elementor-widget-coherence-core-nav-menu ');		
		var layout = $( '.elementor-element-' + id + ' .coherence-core-nav-menu' ).data( 'layout' );
		var flyout_data = $( '.elementor-element-' + id + ' .coherence-core-flyout-wrapper' ).data( 'flyout-class' );
		var last_item = $( '.elementor-element-' + id + ' .coherence-core-nav-menu' ).data( 'last-item' );
		var last_item_flyout = $( '.elementor-element-' + id + ' .coherence-core-flyout-wrapper' ).data( 'last-item' );

		var menu_items_links        = $( '.elementor-element-' + id + ' .coherence-core-nav-menu nav li a' );
		var menu_items_links_flyout = $( '.elementor-element-' + id + ' .coherence-core-flyout-wrapper li a' );
		if (menu_items_links.length > 0) {
			_handle_current_menu_item_class( menu_items_links );
		}

		if (menu_items_links_flyout.length > 0) {
			_handle_current_menu_item_class( menu_items_links_flyout );
		}

		$( 'div.coherence-core-has-submenu-container' ).removeClass( 'sub-menu-active' );

		_toggleClick( id );

		_handlePolylangSwitcher( $scope );

		_handleSinglePageMenu( id, layout );

		if( 'horizontal' !== layout ){

			_eventClick( id );
		}else if ( 'horizontal' === layout && window.matchMedia( "( max-width: 767px )" ).matches ) {

			_eventClick( id );
		}else if ( 'horizontal' === layout && window.matchMedia( "( max-width: 1024px )" ).matches ) {

			_eventClick( id );
		}

		$( '.elementor-element-' + id + ' .coherence-core-flyout-trigger .coherence-core-nav-menu-icon' ).off( 'click keyup' ).on( 'click keyup', function() {

			_openMenu( id );
		} );

		$( '.elementor-element-' + id + ' .coherence-core-flyout-close' ).off( 'click keyup' ).on( 'click keyup', function() {

			_closeMenu( id );
		} );

		$( '.elementor-element-' + id + ' .coherence-core-flyout-overlay' ).off( 'click' ).on( 'click', function() {

			_closeMenu( id );
		} );	


		$scope.find( '.sub-menu' ).each( function() {

			var parent = $( this ).closest( '.menu-item' );

			$scope.find( parent ).addClass( 'parent-has-child' );
			$scope.find( parent ).removeClass( 'parent-has-no-child' );
		});

		if( ( 'cta' == last_item || 'cta' == last_item_flyout ) && 'expandible' != layout ){
			$( '.elementor-element-' + id + ' li.menu-item:last-child a.coherence-core-menu-item' ).parent().addClass( 'elementor-button-wrapper' );
			$( '.elementor-element-' + id + ' li.menu-item:last-child a.coherence-core-menu-item' ).addClass( 'elementor-button' );			
		}

		_borderClass( id );	

		$( window ).on( 'resize', function(){ 

			if( 'horizontal' !== layout ) {

				_eventClick( id );
			}else if ( 'horizontal' === layout && window.matchMedia( "( max-width: 767px )" ).matches ) {

				_eventClick( id );
			}else if ( 'horizontal' === layout && window.matchMedia( "( max-width: 1024px )" ).matches ) {

				_eventClick( id );
			}

			if( 'horizontal' == layout && window.matchMedia( "( min-width: 977px )" ).matches){

				$( '.elementor-element-' + id + ' div.coherence-core-has-submenu-container' ).next().css( 'position', 'absolute');	
			}

			if( 'expandible' == layout || 'flyout' == layout ){

				_toggleClick( id );
			}else if ( 'vertical' == layout || 'horizontal' == layout ) {
				if( window.matchMedia( "( max-width: 767px )" ).matches && ($( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-tablet') || $( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-mobile'))){

					_toggleClick( id );					
				}else if ( window.matchMedia( "( max-width: 1024px )" ).matches && $( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-tablet') ) {
					
					_toggleClick( id );
				}
			}

			_borderClass( id );	

		});

        // Acessibility functions

  		$scope.find( '.parent-has-child .coherence-core-has-submenu-container a').attr( 'aria-haspopup', 'true' );
  		$scope.find( '.parent-has-child .coherence-core-has-submenu-container a').attr( 'aria-expanded', 'false' );

  		$scope.find( '.coherence-core-nav-menu__toggle').attr( 'aria-haspopup', 'true' );
  		$scope.find( '.coherence-core-nav-menu__toggle').attr( 'aria-expanded', 'false' );

  		// End of accessibility functions

		$( document ).trigger( 'hfe_nav_menu_init', id );

		$( '.elementor-element-' + id + ' div.coherence-core-has-submenu-container' ).on( 'keyup', function(e){

			var $this = $( this );

		  	if( $this.parent().hasClass( 'menu-active' ) ) {

		  		$this.parent().removeClass( 'menu-active' );

		  		$this.parent().next().find('ul').css( { 'visibility': 'hidden', 'opacity': '0', 'height': '0' } );
		  		$this.parent().prev().find('ul').css( { 'visibility': 'hidden', 'opacity': '0', 'height': '0' } );

		  		$this.parent().next().find( 'div.coherence-core-has-submenu-container' ).removeClass( 'sub-menu-active' );
		  		$this.parent().prev().find( 'div.coherence-core-has-submenu-container' ).removeClass( 'sub-menu-active' );
			}else { 

				$this.parent().next().find('ul').css( { 'visibility': 'hidden', 'opacity': '0', 'height': '0' } );
		  		$this.parent().prev().find('ul').css( { 'visibility': 'hidden', 'opacity': '0', 'height': '0' } );

		  		$this.parent().next().find( 'div.coherence-core-has-submenu-container' ).removeClass( 'sub-menu-active' );
		  		$this.parent().prev().find( 'div.coherence-core-has-submenu-container' ).removeClass( 'sub-menu-active' );

				$this.parent().siblings().find( '.coherence-core-has-submenu-container a' ).attr( 'aria-expanded', 'false' );

				$this.parent().next().removeClass( 'menu-active' );
		  		$this.parent().prev().removeClass( 'menu-active' );

				event.preventDefault();

				$this.parent().addClass( 'menu-active' );

				if( 'horizontal' !== layout ){
					$this.addClass( 'sub-menu-active' );	
				}
				
				$this.find( 'a' ).attr( 'aria-expanded', 'true' );

				$this.next().css( { 'visibility': 'visible', 'opacity': '1', 'height': 'auto' } );

				if ( 'horizontal' !== layout ) {
						
		  			$this.next().css( 'position', 'relative');			
				} else if ( 'horizontal' === layout && window.matchMedia( "( max-width: 767px )" ).matches && ($( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-tablet') || $( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-mobile'))) {
										
  					$this.next().css( 'position', 'relative');		  					
				} else if ( 'horizontal' === layout && window.matchMedia( "( max-width: 1024px )" ).matches ) {
					
  					if ( $( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-tablet') ) {

  						$this.next().css( 'position', 'relative');	
  					} else if ( $( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-mobile') || $( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-none') ) {
  						
  						$this.next().css( 'position', 'absolute');	
  					}
  				}		
			}
		});

		$( '.elementor-element-' + id + ' li.menu-item' ).on( 'keyup', function(e){
			var $this = $( this );

	 		$this.next().find( 'a' ).attr( 'aria-expanded', 'false' );
	 		$this.prev().find( 'a' ).attr( 'aria-expanded', 'false' );
	  		
	  		$this.next().find('ul').css( { 'visibility': 'hidden', 'opacity': '0', 'height': '0' } );
	  		$this.prev().find('ul').css( { 'visibility': 'hidden', 'opacity': '0', 'height': '0' } );
	  		
	  		$this.siblings().removeClass( 'menu-active' );
	  		$this.next().find( 'div.coherence-core-has-submenu-container' ).removeClass( 'sub-menu-active' );
		  	$this.prev().find( 'div.coherence-core-has-submenu-container' ).removeClass( 'sub-menu-active' );
		  		
		});
	};

	var widgetFeatureList = function($scope , $) {

		if ( 'undefined' == typeof $scope ) return;

		$scope.find('.coherence-feature-list-item:not(:last-of-type)').find('.coherence-feature-list-icon-wrap').each(function(index) {
			var offsetTop = $scope.find('.coherence-feature-list-item').eq(index + 1).find('.coherence-feature-list-icon-wrap').offset().top;
			
			$(this).find('.coherence-feature-list-line').height(offsetTop - $(this).offset().top + 'px');
		});

		$(window).resize(function() {
			$scope.find('.coherence-feature-list-item:not(:last-of-type)').find('.coherence-feature-list-icon-wrap').each(function(index) {
				var offsetTop = $scope.find('.coherence-feature-list-item').eq(index + 1).find('.coherence-feature-list-icon-wrap').offset().top;
				
				$(this).find('.coherence-feature-list-line').height(offsetTop - $(this).offset().top + 'px');
			});
		})
	}

	function _handle_current_menu_item_class( layout_links ) {
		layout_links.each(
			function () {
				var $this = $( this );
				if ($this.is( '[href*="#"]' )) {
					var menu_item_parent = $this.parent();
					menu_item_parent.removeClass( 'current-menu-item current-menu-ancestor' );
					$this.click(
						function () {
							var current_index  = menu_item_parent.index(),
								parent_element = $this.closest( 'ul' );
							parent_element.find( 'li' ).not( ':eq(' + current_index + ')' ).removeClass( 'current-menu-item current-menu-ancestor' );
							menu_item_parent.addClass( 'current-menu-item current-menu-ancestor' );
						}
					)
				}
			}
		);
	}

	function _openMenu( id ) {

		var flyout_content = $( '#coherence-core-flyout-content-id-' + id );
		var layout = $( '#coherence-core-flyout-content-id-' + id ).data( 'layout' );
		var layout_type = $( '#coherence-core-flyout-content-id-' + id ).data( 'flyout-type' );
		var wrap_width = flyout_content.width() + 'px';
		var container = $( '.elementor-element-' + id + ' .coherence-core-flyout-container .coherence-core-side.coherence-core-flyout-' + layout );

		$( '.elementor-element-' + id + ' .coherence-core-flyout-overlay' ).fadeIn( 100 );

		if( 'left' == layout ) {

			$( 'body' ).css( 'margin-left' , '0' );
			container.css( 'left', '0' );

			if( 'push' == layout_type ) {

				$( 'body' ).addClass( 'coherence-core-flyout-animating' ).css({ 
					position: 'absolute',
					width: '100%',
					'margin-left' : wrap_width,
					'margin-right' : 'auto'
				});
			}	

			container.addClass( 'coherence-core-flyout-show' );	
		} else {

			$( 'body' ).css( 'margin-right', '0' );
			container.css( 'right', '0' );

			if( 'push' == layout_type ) {

				$( 'body' ).addClass( 'coherence-core-flyout-animating' ).css({ 
					position: 'absolute',
					width: '100%',
					'margin-left' : '-' + wrap_width,
					'margin-right' : 'auto',
				});
			}

			container.addClass( 'coherence-core-flyout-show' );
		}		
	}

	function _closeMenu( id ) {

		var flyout_content = $( '#coherence-core-flyout-content-id-' + id );
		var layout    = $( '#coherence-core-flyout-content-id-' + id ).data( 'layout' );
		var wrap_width = flyout_content.width() + 'px';
		var layout_type = $( '#coherence-core-flyout-content-id-' + id ).data( 'flyout-type' );
		var container = $( '.elementor-element-' + id + ' .coherence-core-flyout-container .coherence-core-side.coherence-core-flyout-' + layout );

		$( '.elementor-element-' + id + ' .coherence-core-flyout-overlay' ).fadeOut( 100 );	

		if( 'left' == layout ) {

			container.css( 'left', '-' + wrap_width );

			if( 'push' == layout_type ) {

				$( 'body' ).css({ 
					position: '',
					'margin-left' : '',
					'margin-right' : '',
				});

				setTimeout( function() {
					$( 'body' ).removeClass( 'coherence-core-flyout-animating' ).css({ 
						width: '',
					});
				});
			}	

			container.removeClass( 'coherence-core-flyout-show' );					
		} else {
			container.css( 'right', '-' + wrap_width );
			
			if( 'push' == layout_type ) {

				$( 'body' ).css({
					position: '',
					'margin-right' : '',
					'margin-left' : '',
				});

				setTimeout( function() {
					$( 'body' ).removeClass( 'coherence-core-flyout-animating' ).css({ 
						width: '',
					});
				});
			}
			container.removeClass( 'coherence-core-flyout-show' );
		}	
	}

	function _eventClick( id ){

		var layout = $( '.elementor-element-' + id + ' .coherence-core-nav-menu' ).data( 'layout' );

		$( '.elementor-element-' + id + ' div.coherence-core-has-submenu-container' ).off( 'click' ).on( 'click', function( event ) {

			var $this = $( this );

			if( $( '.elementor-element-' + id ).hasClass( 'coherence-core-link-redirect-child' ) ) {

				if( $this.hasClass( 'sub-menu-active' ) ) {

					if( ! $this.next().hasClass( 'sub-menu-open' ) ) {

						$this.find( 'a' ).attr( 'aria-expanded', 'false' );

						if( 'horizontal' !== layout ){

							event.preventDefault();

							$this.next().css( 'position', 'relative' );	
						} else if ( 'horizontal' === layout && window.matchMedia( "( max-width: 767px )" ).matches && ($( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-tablet') || $( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-mobile'))) {
							
							event.preventDefault();

							$this.next().css( 'position', 'relative' );	
						} else if ( 'horizontal' === layout && window.matchMedia( "( max-width: 1024px )" ).matches && ( $( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-tablet') || $( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-mobile'))) {
							
							event.preventDefault();	

							$this.next().css( 'position', 'relative' );	
						}	
					
						$this.removeClass( 'sub-menu-active' );
						$this.nextAll('.sub-menu').removeClass( 'sub-menu-open' );
						$this.nextAll('.sub-menu').css( { 'visibility': 'hidden', 'opacity': '0', 'height': '0' } );
						$this.nextAll('.sub-menu').css( { 'transition': 'none'} );
					} else{

						$this.find( 'a' ).attr( 'aria-expanded', 'false' );
						
						$this.removeClass( 'sub-menu-active' );
						$this.nextAll('.sub-menu').removeClass( 'sub-menu-open' );
						$this.nextAll('.sub-menu').css( { 'visibility': 'hidden', 'opacity': '0', 'height': '0' } );
						$this.nextAll('.sub-menu').css( { 'transition': 'none'} );

						if ( 'horizontal' !== layout ){

							$this.next().css( 'position', 'relative' );
						} else if ( 'horizontal' === layout && window.matchMedia( "( max-width: 767px )" ).matches && ($( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-tablet') || $( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-mobile'))) {
							
							$this.next().css( 'position', 'relative' );	
							
						} else if ( 'horizontal' === layout && window.matchMedia( "( max-width: 1024px )" ).matches && ( $( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-tablet') || $( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-mobile'))) {
							
							$this.next().css( 'position', 'absolute' );				
						}	  								
					}		  											
				} else {

					$this.find( 'a' ).attr( 'aria-expanded', 'true' );
					if ( 'horizontal' !== layout ) {
						
						event.preventDefault();
						$this.next().css( 'position', 'relative');			
					} else if ( 'horizontal' === layout && window.matchMedia( "( max-width: 767px )" ).matches && ($( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-tablet') || $( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-mobile'))) {
						
						event.preventDefault();
						$this.next().css( 'position', 'relative');		  					
					} else if ( 'horizontal' === layout && window.matchMedia( "( max-width: 1024px )" ).matches ) {
						event.preventDefault();

						if ( $( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-tablet') ) {

							$this.next().css( 'position', 'relative');	
						} else if ( $( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-mobile') || $( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-none') ) {
							
							$this.next().css( 'position', 'absolute');	
						}
					}	
							
					$this.addClass( 'sub-menu-active' );
					$this.nextAll('.sub-menu').addClass( 'sub-menu-open' );
					$this.nextAll('.sub-menu').css( { 'visibility': 'visible', 'opacity': '1', 'height': 'auto' } );
					$this.nextAll('.sub-menu').css( { 'transition': '0.3s ease'} );
				}
			}
		});

		$( '.elementor-element-' + id + ' .coherence-core-menu-toggle' ).off( 'click keyup' ).on( 'click keyup',function( event ) {

			var $this = $( this );

		  	if( $this.parent().parent().hasClass( 'menu-active' ) ) {

	  			event.preventDefault();

				$this.parent().parent().removeClass( 'menu-active' );
				$this.parent().parent().next().css( { 'visibility': 'hidden', 'opacity': '0', 'height': '0' } );

				if ( 'horizontal' !== layout ) {
						
		  			$this.parent().parent().next().css( 'position', 'relative');			
				} else if ( 'horizontal' === layout && window.matchMedia( "( max-width: 767px )" ).matches && ($( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-tablet') || $( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-mobile'))) {
										
  					$this.parent().parent().next().css( 'position', 'relative');		  					
				} else if ( 'horizontal' === layout && window.matchMedia( "( max-width: 1024px )" ).matches ) {
					
  					if ( $( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-tablet') ) {

  						$this.parent().parent().next().css( 'position', 'relative');	
  					} else if ( $( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-mobile') || $( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-none') ) {
  						
  						$this.parent().parent().next().css( 'position', 'absolute');	
  					}
  				}
			}else { 

				event.preventDefault();

				$this.parent().parent().addClass( 'menu-active' );

				$this.parent().parent().next().css( { 'visibility': 'visible', 'opacity': '1', 'height': 'auto' } );

				if ( 'horizontal' !== layout ) {
						
		  			$this.parent().parent().next().css( 'position', 'relative');			
				} else if ( 'horizontal' === layout && window.matchMedia( "( max-width: 767px )" ).matches && ($( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-tablet') || $( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-mobile'))) {
										
  					$this.parent().parent().next().css( 'position', 'relative');		  					
				} else if ( 'horizontal' === layout && window.matchMedia( "( max-width: 1024px )" ).matches ) {
					
  					if ( $( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-tablet') ) {

  						$this.parent().parent().next().css( 'position', 'relative');	
  					} else if ( $( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-mobile') || $( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-none') ) {
  						
  						$this.parent().parent().next().css( 'position', 'absolute');	
  					}
  				}		
			}
		});
	}

	function _borderClass( id ){

		var last_item = $( '.elementor-element-' + id + ' .coherence-core-nav-menu' ).data( 'last-item' );
		var last_item_flyout = $( '.elementor-element-' + id + ' .coherence-core-flyout-wrapper' ).data( 'last-item' );
		var layout = $( '.elementor-element-' + id + ' .coherence-core-nav-menu' ).data( 'layout' );

		$( '.elementor-element-' + id + ' nav').removeClass('coherence-core-dropdown');

		if ( window.matchMedia( "( max-width: 767px )" ).matches ) {

			if( $( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-mobile') || $( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-tablet')){
				
				$( '.elementor-element-' + id + ' nav').addClass('coherence-core-dropdown');
				if( ( 'cta' == last_item || 'cta' == last_item_flyout ) && 'expandible' != layout ){
					$( '.elementor-element-' + id + ' li.menu-item:last-child a.coherence-core-menu-item' ).parent().removeClass( 'elementor-button-wrapper' );
					$( '.elementor-element-' + id + ' li.menu-item:last-child a.coherence-core-menu-item' ).removeClass( 'elementor-button' );	
				}	
			}else{
				
				$( '.elementor-element-' + id + ' nav').removeClass('coherence-core-dropdown');
				if( ( 'cta' == last_item || 'cta' == last_item_flyout ) && 'expandible' != layout ){
					$( '.elementor-element-' + id + ' li.menu-item:last-child a.coherence-core-menu-item' ).parent().addClass( 'elementor-button-wrapper' );
					$( '.elementor-element-' + id + ' li.menu-item:last-child a.coherence-core-menu-item' ).addClass( 'elementor-button' );	
				}
			}
		}else if ( window.matchMedia( "( max-width: 1024px )" ).matches ) {

			if( $( '.elementor-element-' + id ).hasClass('coherence-core-nav-menu__breakpoint-tablet') ) {
				
				$( '.elementor-element-' + id + ' nav').addClass('coherence-core-dropdown');
				if( ( 'cta' == last_item || 'cta' == last_item_flyout ) && 'expandible' != layout ){
					$( '.elementor-element-' + id + ' li.menu-item:last-child a.coherence-core-menu-item' ).parent().removeClass( 'elementor-button-wrapper' );
					$( '.elementor-element-' + id + ' li.menu-item:last-child a.coherence-core-menu-item' ).removeClass( 'elementor-button' );	
				}
			}else{
				
				$( '.elementor-element-' + id + ' nav').removeClass('coherence-core-dropdown');
				if( ( 'cta' == last_item || 'cta' == last_item_flyout ) && 'expandible' != layout ){
					$( '.elementor-element-' + id + ' li.menu-item:last-child a.coherence-core-menu-item' ).parent().addClass( 'elementor-button-wrapper' );
					$( '.elementor-element-' + id + ' li.menu-item:last-child a.coherence-core-menu-item' ).addClass( 'elementor-button' );
				}
			}
		}else {
			var $parent_element = $( '.elementor-element-' + id );
			$parent_element.find( 'nav').removeClass( 'coherence-core-dropdown' );
			if( ( 'cta' == last_item || 'cta' == last_item_flyout ) && 'expandible' != layout ){
				$parent_element.find( 'li.menu-item:last-child a.coherence-core-menu-item' ).parent().addClass( 'elementor-button-wrapper' );
				$parent_element.find( 'li.menu-item:last-child a.coherence-core-menu-item' ).addClass( 'elementor-button' );
			}
		}

		var layout = $( '.elementor-element-' + id + ' .coherence-core-nav-menu' ).data( 'layout' );
		if( 'expandible' == layout ){
			if( ( 'cta' == last_item || 'cta' == last_item_flyout ) && 'expandible' != layout ){
				$( '.elementor-element-' + id + ' li.menu-item:last-child a.coherence-core-menu-item' ).parent().removeClass( 'elementor-button-wrapper' );
				$( '.elementor-element-' + id + ' li.menu-item:last-child a.coherence-core-menu-item' ).removeClass( 'elementor-button' );			
			}			
		}
	}

	function _toggleClick( id ){

		if ( $( '.elementor-element-' + id + ' .coherence-core-nav-menu__toggle' ).hasClass( 'coherence-core-active-menu-full-width' ) ){

			$( '.elementor-element-' + id + ' .coherence-core-nav-menu__toggle' ).next().css( 'left', '0' );

			var width = $( '.elementor-element-' + id ).closest('.elementor-section').outerWidth();
			var sec_pos = $( '.elementor-element-' + id ).closest('.elementor-section').offset().left - $( '.elementor-element-' + id + ' .coherence-core-nav-menu__toggle' ).next().offset().left;
			$( '.elementor-element-' + id + ' .coherence-core-nav-menu__toggle' ).next().css( 'width', width + 'px' );
			$( '.elementor-element-' + id + ' .coherence-core-nav-menu__toggle' ).next().css( 'left', sec_pos + 'px' );
		}

		$( '.elementor-element-' + id + ' .coherence-core-nav-menu__toggle' ).off( 'click keyup' ).on( 'click keyup', function( event ) {

			var $this = $( this );
			var $selector = $this.next();

			if ( $this.hasClass( 'coherence-core-active-menu' ) ) {

				var layout = $( '.elementor-element-' + id + ' .coherence-core-nav-menu' ).data( 'layout' );
				var full_width = $selector.data( 'full-width' );
				var toggle_icon = $( '.elementor-element-' + id + ' nav' ).data( 'toggle-icon' );

				$( '.elementor-element-' + id).find( '.coherence-core-nav-menu-icon' ).html( toggle_icon );

				$this.removeClass( 'coherence-core-active-menu' );
				$this.attr( 'aria-expanded', 'false' );
				
				if ( 'yes' == full_width ){

					$this.removeClass( 'coherence-core-active-menu-full-width' );
				
					$selector.css( 'width', 'auto' );
					$selector.css( 'left', '0' );
					$selector.css( 'z-index', '0' );
				}				
			} else {

				var layout = $( '.elementor-element-' + id + ' .coherence-core-nav-menu' ).data( 'layout' );
				var full_width = $selector.data( 'full-width' );
				var close_icon = $( '.elementor-element-' + id + ' nav' ).data( 'close-icon' );

				$( '.elementor-element-' + id).find( '.coherence-core-nav-menu-icon' ).html( close_icon );
				
				$this.addClass( 'coherence-core-active-menu' );
				$this.attr( 'aria-expanded', 'true' );

				if ( 'yes' == full_width ){

					$this.addClass( 'coherence-core-active-menu-full-width' );

					var width = $( '.elementor-element-' + id ).closest('.elementor-section').outerWidth();
					var sec_pos = $( '.elementor-element-' + id ).closest('.elementor-section').offset().left - $selector.offset().left;
				
					$selector.css( 'width', width + 'px' );
					$selector.css( 'left', sec_pos + 'px' );
					$selector.css( 'z-index', '9999' );
				}
			}

			if( $( '.elementor-element-' + id + ' nav' ).hasClass( 'menu-is-active' ) ) {

				$( '.elementor-element-' + id + ' nav' ).removeClass( 'menu-is-active' );
			}else {

				$( '.elementor-element-' + id + ' nav' ).addClass( 'menu-is-active' );
			}				
		} );
	}

	function _handleSinglePageMenu( id, layout ) {
		$( '.elementor-element-' + id + ' ul.coherence-core-nav-menu li a' ).on(
			'click',
			function () {
				var $this = $( this );
				var link  = $this.attr( 'href' );
				var linkValue = '';
				if ( link.includes( '#' ) ) {
					var index     = link.indexOf( '#' );
					linkValue = link.slice( index + 1 );
				}
				if ( linkValue.length > 0 ) {
					if ( 'expandible' == layout ) {
						$( '.elementor-element-' + id + ' .coherence-core-nav-menu__toggle' ).trigger( "click" );
						if ($this.hasClass( 'coherence-core-sub-menu-item' )) {
							$( '.elementor-element-' + id + ' .coherence-core-menu-toggle' ).trigger( "click" );
						}
					} else {
						if ( window.matchMedia( '(max-width: 1024px)' ).matches && ( 'horizontal' == layout || 'vertical' == layout ) ) {
							$( '.elementor-element-' + id + ' .coherence-core-nav-menu__toggle' ).trigger( "click" );
							if ($this.hasClass( 'coherence-core-sub-menu-item' )) {
								$( '.elementor-element-' + id + ' .coherence-core-menu-toggle' ).trigger( "click" );
							}
						} else {
							if ($this.hasClass( 'coherence-core-sub-menu-item' )) {
								_closeMenu( id );
								$( '.elementor-element-' + id + ' .coherence-core-menu-toggle' ).trigger( "click" );
							}
							_closeMenu( id );
						}
					}
				}
			}
		);
	}

	/**
	 * This function handles polylang plugin's lang switcher if present in the menu.
	 *
	 * @param {Object} $scope The current element(hfe nav menu) wrapped with jQuery.
	 */
	function _handlePolylangSwitcher( $scope ) {
		var polylangSwitcher = $scope.find( '.coherence-core-nav-menu nav .pll-parent-menu-item a.coherence-core-menu-item' );
		var hrefProperty     = polylangSwitcher.prop( 'href' );
		if ( undefined !== hrefProperty && hrefProperty.includes( '#' ) ) {
			var index = hrefProperty.indexOf( '#' );
			var value = hrefProperty.slice( index );
			if ( value === '#pll_switcher' ) {
				polylangSwitcher.prop( 'href', '#' );
			}
		}
	}

	$( window ).on( 'elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/menu.default', WidgethfeNavMenuHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/search-button.default', WidgethfeSearchButton );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/coherence-feature-list.default', widgetFeatureList );
	});
} )( jQuery );
