$(function(){
	//sp版メニュー
	$('.sp-g-nav-btn').on('click' , '.accordion-control', function(e){
		e.preventDefault();
		// クリックしたリストの開閉
		$(this)
			.next('.accordion-panel')
			.slideToggle();
	});
	
	// このページのトップへ
	$('#move-page-top').click(function(){
		$( 'html,body' ).animate( {scrollTop:0} , 'fast' ) ;
	});

});

// このページのトップへ
$(window).scroll(
	function()
	{
		var now = $( window ).scrollTop() ;
		if( now > 100 )
		{
			$( '#page-top' ).fadeIn( "slow" ) ;
		}
		else
		{
			$( '#page-top' ).fadeOut( 'fast' ) ;
		}	
	}
) ;

