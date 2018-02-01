$('.order_shonc li').click(function(){
    $('.order_shonc li').removeClass('order_shoncon');
    $(this).addClass('order_shoncon');
    var id = $(this).attr('data-id');
    var province = $( this ).data('province');
    var city = $( this ).data('city');
    var district = $( this ).data('district');
    var place = $( this ).data('place');
    var consignee = $( this ).data('consignee');
    var telephone = $( this ).data('telephone');
    $("#address").html(province+' '+city+' '+district+' '+place);
    $(".consignee").html(consignee+' '+telephone);
})

function get_checked_address(){
    var id = $(".address .order_shoncon").attr("data-id");
    return {address_id:id};
}

function get_checked_payway(){
    var pay_way = $(".pay_way .pro_xz").attr("data-pay_way");
    return {pay_way:pay_way};
}
