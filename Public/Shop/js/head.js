
    window.alert = function (msg){
        dialog.showTips(msg, "warn");
    }
    var dialog = {
        /*
         type为firm时，url传回调参数
         */
        showTips : function (msg,type,url){

            var htmlCon="";

            if(type=='warn'){

                htmlCon='<div class="wap_tanc" style="display: block;">'+
                    '<div class="wap_tanc_bg"></div>'+
                    '<div class="wap_tanc_con" style="display: block;">'+
                    '<h5>'+msg+'</h5>'+
                    '<div class="wap_tanc_btn clearfix">'+
                    '<a href="javascript:void(0)" style="width:100%;" class="close1">确定</a>'+
                    '</div>'+
                    '</div>'+
                    '</div>';

            }else if(type=="firm"){

                htmlCon='<div class="wap_tanc" style="display: block;">'+
                    '<div class="wap_tanc_bg"></div>'+
                    '<div class="wap_tanc_con" style="display: block;">'+
                    '<h5>'+msg+'</h5>'+
                    '<div class="wap_tanc_btn clearfix">'+
                    '<a href="javascript:void(0)" class="close1" style="border-right:1px solid #f1f1f1;">取消</a>'+
                    '<a href="javascript:void(0)" class="continue" >确定</a>'+
                    '</div>'+
                    '</div>'+
                    '</div>';

            }else{

                if(url!=""){

                    if(url=="1"){
                        htmlCon='<div class="wap_tanc" style="display: block;">'+
                            '<div class="wap_tanc_bg"></div>'+
                            '<div class="wap_tanc_con" style="display: block;">'+
                            '<h5>'+msg+'</h5>'+
                            '<div class="wap_tanc_btn clearfix">'+
                            '<a href="javascript:void(0)" style="width:100%;" class="reload">确定</a>'+
                            '</div>'+
                            '</div>'+
                            '</div>';

                    }else{

                        htmlCon='<div class="wap_tanc" style="display: block;">'+
                            '<div class="wap_tanc_bg"></div>'+
                            '<div class="wap_tanc_con" style="display: block;">'+
                            '<h5>'+msg+'</h5>'+
                            '<div class="wap_tanc_btn clearfix">'+
                            '<a href="'+url+'" style="width:100%;">确定</a>'+
                            '</div>'+
                            '</div>'+
                            '</div>';
                    }



                }else{

                    htmlCon='<div class="wap_tanc" style="display: block;">'+
                        '<div class="wap_tanc_bg"></div>'+
                        '<div class="wap_tanc_con" style="display: block;">'+
                        '<h5>'+msg+'</h5>'+
                        '<div class="wap_tanc_btn clearfix">'+
                        '<a href="##" style="border-right:1px solid #f1f1f1;">取消</a>'+
                        '<a href="##">确定</a>'+
                        '</div>'+
                        '</div>'+
                        '</div>';

                }

            }
            $('body').append(htmlCon);

            //$('body').prepend("pllp");

            $('.close1').click(function(){
                $('.wap_tanc').stop(true).fadeOut(300);
                $('.wap_tanc_con').stop(true).fadeOut(300);
                if(typeof url == "function" && type=='warn'){url();}
                return false;
            });

            $(".reload").click(function(){

                location.reload();

            });

            $(".continue").click(function (){
                url();
                $('.close1').trigger("click");
            })
        }
    }
