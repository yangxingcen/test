$(document).ready(function(){
    /****折叠1***/
    $(".cate").click(function(){
        var _pid    = parseInt($(this).attr('data-id'));
        var _open   = parseInt($(this).attr('data-open'));
        var _parent = $(this).parent().parent();
        if(_pid){
            _open   = _open ? 0 : 1;
            $(this).attr('data-open',_open);
            var txt = _open ? '-' : '+';
            $(this).find("span").text(txt)
            _parent.find("tr[class^='subcate_"+_pid+"_']").toggle();
        }
    });
    /****折叠2***/
});