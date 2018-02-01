$(function(){
    $( document ).ready( function()
    {

        var hei = $( ".meal_img" ).width()*600/518;

        $( ".div_img" ).height( (hei - 15) / 2 - 75 )

    } )
    $( window ).resize( function()
    {
        var hei = $( ".meal_img" ).width()*600/518;

        $( ".div_img" ).height( (hei - 15) / 2 - 75 )

    } )
    $( window ).scroll( function()
    {

    } )
})