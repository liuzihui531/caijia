$(function(){
	FontSize()
	$(window).resize(function(){
			FontSize()
		})
	function FontSize(){
		if($(window).width()<640){
			$("html").css("font-size",$(window).width()/640*20);
		}else{
			$("html").css("font-size",20);
		}
	}
})

$(function(){
	
	
	
	//购物车 加减  
    $(".add").click(function(){
        var n=$(this).parents("li").find(".input_num").val();
        var num=parseInt(n)+1;
        //if(num==0){alert("cc");}
        $(this).parents("li").find(".input_num").val(num);
    });
    $(".jian").click(function(){
        var n=$(this).parents("li").find(".input_num").val();
        var num=parseInt(n)-1;
        if(num==0){return}
        $(this).parents("li").find(".input_num").val(num);
    });
	
});



$(function(){
 var tabTitle = ".tab dt span";
 var tabContent = ".tab dd";
 $(tabTitle + ":first").addClass("hover");
 $(tabContent).not(":first").hide();
 $(tabTitle).unbind("click").bind("click", function(){
  $(this).siblings("span").removeClass("hover").end().addClass("hover");
  var index = $(tabTitle).index( $(this) );
  $(tabContent).eq(index).siblings(tabContent).hide().end().fadeIn(0);
   });
});

