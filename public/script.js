$(document).on('click', '.add', function(e){
    e.preventDefault();
    e.stopImmediatePropagation();
    return false;
});
$(document).on('click', '.menu', function(e1){
    e1.preventDefault();
    e1.stopImmediatePropagation();
    return false;
});
$(function(){

    sum();

    $('.add').click(function(){
        
        var val,text,node;
        var prod=$(this).prev().prev().text();
        if($(this).prev().has('select').length!==0)
        {
            node=$(this).prev().children('select');
            val=node.val();
            text=": "+node.children(":selected").text();
        }
        else{
            val= $(this).prev().children('input').val();
            text=$(this).prev().text();
        }
        text=prod+" "+text.trim();
        console.log(val);
        
        pop_up(text);

        $.ajax({
            type:"GET",
            url:"data_handlers/cart_add.php",
            data: 'value=' +val,
            success: function(msg)
            {
                console.log(msg);
            }
        });
    });

    function pop_up(text){
        $("#fill").text(text);
        $("#added-to-cart").slideDown(1000);
        setTimeout(function(){
            $("#added-to-cart").slideUp(1000);
        },3000);
    }

    $(".remove").click(function(){

        modify_cart($(this),0);
        
    });

    function modify_cart(node,quant)
    {
        var node=node.parent().siblings('input');
         var cid=node.val();

         $.ajax({
             type:"GET",
             url:"data_handlers/cart_change.php",
             data: 'cid='+cid+'&quant='+quant,
             success: function(msg)
             {
                 remove_node(node,quant);
             }
         });
    }

    function remove_node(node,quant)
    {
        if(quant==0)
        {
            node.parent().remove();
        }
        sum();
    }

    $(".plus").click(function(){
        
        quantity=parseInt(($(this).siblings('span').text()))+1;
        $(this).siblings('span').text(quantity);

        modify_cart($(this),quantity);
    });

    $(".minus").click(function(){
        
        quantity=($(this).siblings('span').text())-1;
        $(this).siblings('span').text(quantity);
        
        modify_cart($(this),quantity);
    });

    function sum(){
        var sum=0;

        $(".item").each(function(){
            var cost=parseInt($(this).children('.cost').text());
            var quant=parseInt($(this).children('.quant').children('span').text());
            sum+=cost*quant;
        });
        if(sum==0)
        {
            $('#checkout').remove();
        }
        else
        {
            $('#sum').text(sum);
        }
    }

    $("#bars").click(function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        $("#v-menu").css("left","0");

    });

    $("html").click(function(e){
        var $v_menu=$("#v-menu");
        if(e.target!=$v_menu.get(0))
        {
            $("#v-menu").css("left","-52%");
        }

        var $overlay=$("#overlay");
        if(e.target==$overlay.get(0))
        {
            $("#overlay").remove();
        }
    });

    $("html").keyup(function(e) {
        if (e.keyCode == 27) { // escape key maps to keycode `27`
            $("#overlay").remove();
       }
   });

    $(".gallery_img").click(function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        var img_source=$(this).attr('href');
        $img=$("<img src='"+img_source+"'>").css('opacity',0).load(display);
        
    });

    function display(){
		// add overlay
		$('<div id="overlay"><div id="photo"></div></div>').prependTo('body');
		// select photo div
		var $photoDiv = $('#photo');
		//add to the #photo div
		$photoDiv.append($img);	
        
        if($img.outerWidth()>=$(window).outerWidth())
        {
            $img.css("width",(0.75*$(window).outerWidth()));
        }
        if($img.outerHeight()>=$(window).outerHeight())
        {
            $img.css("height",(0.75*$(window).outerHeight()));
        }
        $photoDiv.css('margin-left',(($(window).outerWidth()-$photoDiv.outerWidth())/2));
        $photoDiv.css('margin-top',(($(window).outerHeight()-$photoDiv.outerHeight())/2));

    	//fade in new image
		$img.animate({opacity: 1}, 1000);
    }
});
