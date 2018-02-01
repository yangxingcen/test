// JavaScript Document


/***************手机导航***************/
$(function(){
   $('.nav_btn').click(function(){
	  $('.phone_nav').height($(window).height());  
	  $('.phone_nav').stop(true).animate({top:"0",opacity:"1","z-index":"999999"},600,function(){
		  $('.phone_nav').css("position","fixed")
		  })
	  $('.nav_btn1').stop(true).delay(300).animate({top:"15px",opacity:"1"},600)   
   })
   $('.nav_btn1').click(function(){
	  $('.phone_nav').stop(true).animate({top:"80px",opacity:"0","z-index":"-1"},600,function(){
		 $('.phone_nav').css("position","absolute") 
		  $('.phone_nav').height(0); 
	     })
	  $('.nav_btn1').stop(true).animate({top:"90px",opacity:"0"},600)   
   })
	  
   $('.phone_nav>ul>li').click(function(){
	   if($(this).find('ul').css("display")=="none"){
		   $('.phone_nav>ul>li').find('ul').stop(true).slideUp(300);
	       $(this).find('ul').stop(true).slideDown(300);
		   }else{
			   $('.phone_nav>ul>li').find('ul').stop(true).slideUp(300);
	           $(this).find('ul').stop(true).slideUp(300);
			   }
	   })	  
   	
})
/***************手机导航***************/	