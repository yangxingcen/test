$(function(){
    $( document ).ready( function()
    {

        var hei = $( ".meal_img" ).width() + 75;

        $( ".div_img" ).height( (hei - 15) / 2 - 75 )

    } )
    $( window ).resize( function()
    {

        //      $( ".swiper1" ).height( 600 )

    } )
    $( window ).scroll( function()
    {

    } )
})