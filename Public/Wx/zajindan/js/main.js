// JavaScript Document

$(document).ready(function(){
	

   
   $(window).resize(function(){

	   })
	
})








/*******banner**********/

/*******banner**********/











/*******中奖名单**********/
$(document).ready(function(){





	var y1 = $( '.index_sec4_box>ul>li' ).size();
	var x1 = $( '.index_sec4_box>ul>li' ).height() + 30;
	var play = 0;
	var x = 0;
	var d = 0;

	function gundong()
	{
		if( y1 > 5 )
		{

			play = setInterval( function()
			{
				if( x > x1 )
				{
					x = 0;
					$( '.index_sec4_box>ul' ).find( 'li:first-child' ).appendTo( $( '.index_sec4_box>ul' ) );
					$( '.index_sec4_box>ul' ).css( { marginTop: 0 } );
					$( '.index_sec4_box>ul' ).stop( true, true ).animate( { marginTop: -x }, 0, 'linear' );
				}
				else
				{
					$( '.index_sec4_box>ul' ).stop( true, true ).animate( { marginTop: -x }, 1, 'linear' );
					x++;
				}
			}, 40 );
		}
	}

	gundong();


})
/*******中奖名单**********/




