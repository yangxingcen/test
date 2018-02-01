
    $( '.pro_class h5 strong ' ).click( function()
    {
        var _this = $( this );
        if( $( '.pro_class h5 ' ).css( 'height' ) == '30px' )
        {
            _this.parents( "h5" ).animate( {height: "65px"} );
            $( ".pro_class h5 strong b" ).text( '收起' )
        }
        else
        {
            $( ".pro_class h5 strong b" ).text( '更多' )
            _this.parents( "h5" ).animate( {height: "30px"} );
        }
    } )

    $( document ).ready( function()
    {
        var hei = $( ".meal_img" ).width() + 75;
        $( ".div_img" ).height( (hei - 15) / 2 - 75 )
    } )

    $('.pro_list_tops input').click(function(){
        $(this).toggleClass('j_checkbox_on')
    })

