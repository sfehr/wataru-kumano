/**
 * File wk-scripts.js
 *
 *
 * CONTENT OBJECT CONSTRUCTOR
 * INDEXING PROJECTS
 * SCROLL TO ANCHOR FUNCTION	
 * TOP SCROLL STATE 
 * NAV ACTIVE STATE
 * NAV BAR HOVER INTERACTION
 * UPDATE CONTENT
 * IMAGE CLASS RIGHT
 *  
*/

jQuery( document ).ready( function( $ ) {
	
	// VARIABLES
	var projects = {};
	var project_index = 0;
	var offset_top = 200;
	var nav_content_container = $( '#nav-bar .nav-content-container' );
	var nav_site_logo = $( '#nav-bar .logo' );
	var nav_project_title = $( '#nav-bar .project-title' );
	var nav_project_type = $( '#nav-bar .project-type' );
	var nav_project_year = $( '#nav-bar .project-year' );
	var site_sections = '.site-main .project';


	
	// CONTENT OBJECT CONSTRUCTOR
	function Project( id, title, content, type, year ) {
		
		this.id = id;
		this.title = title;
		this.content = content;
		this.type = type;
		this.year = year;
		
	}	
	

	// INDEXING PROJECTS
	$( 'body' ).find( site_sections ).each( function( index ){
		
		// Get the content
		var id = $( this ).attr( 'id' );
		var title = $( this ).find( '.project-title' ).html();
		var content = $( this ).find( '.project-content' );
		var type = $( this ).find( '.project-type' ).html();
		var year = $( this ).find( '.project-year' ).html();

		// Creating objects based on the content
		projects[ index ] = new Project( id, title, content, type, year );
	});
	
	update_content();
	

	
	// SCROLL TO ANCHOR FUNCTION	
	$( 'a[href^=\\#]' ).click( function( e ) { 
		e.preventDefault(); 
		var dest = $( this ).attr( 'href' ); 
		
		$( 'html, body' ).animate({ 
			scrollTop: $( dest ).offset().top + 2 }, 'smooth' ); 
	});
	
	
	
	// TOP SCROLL STATE
	$( window ).on( 'scroll', function(){	
		if( $( window ).scrollTop() > offset_top ){

			$( 'body' ).addClass( 'detached' );
		}
		else{
			$( 'body' ).removeClass( 'detached' );
		}
	});
	
	
	
	// NAV ACTIVE STATE
	let mainNavLinks = document.querySelectorAll( '.anchor-link' );

	window.addEventListener( 'scroll', event => {
		let fromTop = window.scrollY;
		mainNavLinks.forEach( link => {
			let section = document.querySelector( link.hash );

			if( section.offsetTop <= fromTop && section.offsetTop + section.offsetHeight > fromTop ) {
				link.classList.add( 'current' );
				// update project index with current navigation position
				project_index = $( link ).parent().index();
								
				update_content();
			} 
			else {
			link.classList.remove( 'current' );
			}
		});
	});	
	
	

	// NAV BAR HOVER INTERACTION
	// Expand the nav bar on hover (or click for mobile)
	nav_site_logo.add( nav_project_title ).add( nav_project_type ).add( nav_project_year ).on( 'mouseenter click', function( e ){
		
		// collapse/close when active nav bar element is clicked.
		if( e.type == 'click' ){ 
		
			if( $( this ).is( nav_site_logo ) && $( '#nav-bar' ).hasClass( 'expand-profile' ) ){ 
				sf_collapse_nav_bar();
				return;
			}
			if( $( this ).is( nav_project_title ) && $( '#nav-bar' ).hasClass( 'expand-title' ) ){ 
				sf_collapse_nav_bar();
				return;
			}
			if( ( $( this ).is( nav_project_type ) && $( '#nav-bar' ).hasClass( 'expand-navigation' ) ) || ( $( this ).is( nav_project_year ) && $( '#nav-bar' ).hasClass( 'expand-navigation' ) ) ){ 
				sf_collapse_nav_bar();
				return;
			}					
			
		}			
				
		// Add expand class, update content
		if( $( this ).is( nav_site_logo ) ){
			$( '#nav-bar' ).addClass( 'expand-profile' );
			$( '#nav-bar' ).removeClass( 'expand-title expand-navigation' );
		}		
		if( $( this ).is( nav_project_title ) ){
			$( '#nav-bar' ).addClass( 'expand-title' );
			$( '#nav-bar' ).removeClass( 'expand-profile expand-navigation' );
			nav_content_container.html( projects[ project_index ].content );
		}
		if( $( this ).is( nav_project_type ) || $( this ).is( nav_project_year ) ){
			$( '#nav-bar' ).addClass( 'expand-navigation' );
			$( '#nav-bar' ).removeClass( 'expand-title expand-profile' );
		}		
		
	});
	
	// Collapse the nav bar on leave with a delay of 500ms (for smooth animation in css)
	$( '#nav-bar' ).on( 'mouseleave', sf_collapse_nav_bar );
	
	function sf_collapse_nav_bar(){
		setTimeout( function(){
			$( '#nav-bar' ).removeClass( 'expand-title expand-profile expand-navigation' );
		}, 250 );				
	}

	
	
	// UPDATE CONTENT
	function update_content(){
		
		nav_project_title.html( projects[ project_index ].title );
		nav_project_type.html( projects[ project_index ].type );
		nav_project_year.html( projects[ project_index ].year );
		
	}
	
	
	// IMAGE CLASS RIGHT
	$( '.itm:odd' ).each( function(){
		$( this ).addClass( 'right' );
	});
	
	$( '.itm' ).each( function(){
		
		var rand =  Math.floor( ( Math.random() * 3 ) );
		
		if( 1 == rand ){
			$( this ).addClass( 'bottom' );
		}
		if( 2 == rand ){
			$( this ).addClass( 'center' );
		}		
	});	
	

});