$(function(){
    $("#take").click(function (){
        var money  = $("#money").val();
        var bankid = $("#bank").val();
        if(!money.match(/^[0-9]+(\.[0-9]{1,2})?$/)){
            alert("请输入正确的提取金额！");return false;
        }
        if(parseFloat(money)>parseFloat("{$userinfo['wallet']}")){
            alert("余额不足！");return false;
        }
        if(!bankid){
            alert("请选择提取金额的银行卡！");return false;
        }
        $.post("{:U('Ucenter/applyTakeMoney')}",{money:money,bankid:bankid}, function (data){
            if(data.status == 1){
                dialog.showTips(data.info, "firm",function (){
                    window.location.reload();
                })
            }else{
                alert(data.info);
            }
        })
    })
})