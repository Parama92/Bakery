$(function(){

    sum();
    showFav();

    $('.like').click(function(){

        let hidden=$(this).data('hidden');
        $(this).data('hidden',(hidden=="show"?"hide":"show"));

        var $display=$(this).css('color');
        var file;
        if($display!=='rgb(255, 207, 191)')
        {
            makeFav($(this));
            file="add_fav";
        }
        else
        {
            removeFav($(this));
            file="remove_fav";
        }
        fav($(this).parent(),file);
        
    });

    function makeFav($node)
    {
        $node.siblings('i').css({
            'display':'inline-block',
            'color':'#ffcfbf'
        });
        $node.css({
            'color':'#ffcfbf'
        });
    }

    function removeFav($node)
    {
        $node.siblings('i').css({
            'color':'white'
        });
        $node.css({
            'color':'black'
        });
    }

    function showFav()
    {
        $('.like').each(function(){
            let hidden=$(this).data('hidden');
            
            if(hidden=="show")
            {
                makeFav($(this));
            }
        });
    }

    function fav($node,file)
    {
        $product=$node.siblings(".caption").children('p').first().text().trim();
        $.ajax({
            type:"GET",
            url:"data_handlers/"+file+".php",
            data: 'prod=' +$product,
            success: function(msg)
            {
                console.log(msg);
            }
        });
    }

    $(".not-mobile").hover(function(){
        $(this).children("img").css({"opacity":"0.2"});
        $(this).children(".img-caption").css("display","block");
    },function(){
        $(this).children("img").css("opacity","1");
        $(this).children(".img-caption").css("display","none");
    });

    $('input, textarea').blur(function() {

        if (($(this).val().trim()).length<1) 
        {
            $('#error').hide();
            $(this).siblings('.error').show();
        }
        else
        {
            $(this).siblings('.error').hide();
        }
        
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var isValidEmail=re.test($("#email").val());

        if(isValidEmail)
        {
            $("#email").siblings('.error').hide();
        }
        else
        {
            $("#email").siblings('.error').text("Invalid Email!").show();
        }

    });

    $("#contact-form button").click(function(){
        
        let isValid=true, empty;

        $('input, textarea').each(function() {
            isValid= isValid && ($(this).val()!='');
        });

        empty=!isValid;

        $('.error').each(function(){
            isValid= isValid && ($(this).css('display')=='none');
        });
        
        if(empty)
        {
            $('#error').text("Empty form fields!").show();
            return false;
        }
        else{
            $('#error').hide();
        }

        $.ajax({
            type: 'GET',
            url: 'send_mail.php',
            data: 'name='+$('#name').val()+'&email='+$('#email').val()+'&message='+$('#message').val(),
            success: function(msg)
            {
                if(msg.trim()=='')
                {
                    $("#error").hide();
                    $('input, textarea').each(function() {
                        $(this).val('');
                    });
                    pop_up("Enquiry submitted!");
                }
                else
                {
                    $("#error").text(msg).show();
                } 
            }
        });
    });    

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
        $("#message-box").slideDown(1000);
        setTimeout(function(){
            $("#message-box").slideUp(1000);
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

    // $("#submit").click(function(){
    //     let products='';
    //     $(".item").each(function(){
    //         products+=','+$(this).children(".prod-name").text().trim();
    //     });
    //     $('#products').val(products);
    // });

    function sum(){
        var sum=0;

        $(".item").each(function(){
            var cost=parseInt($(this).children('div').children('.cost').text());
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
        $('<div id="overlay"></div>').prependTo('body');
        $("#v-menu").css("left","0");

    });

    $("#fav").click(function(){
        let display=$("#fav_list").css("display");

        if(display=="none")
        {
            $("#fav_list").slideDown(2000);
        }
        else
        {
            $("#fav_list").slideUp(2000);
        }
    })

    $("html").click(function(e){
        var $v_menu=$("#v-menu");
        if(e.target!=$v_menu.get(0))
        {
            $("#v-menu").css("left","-52%");
        }

        var $overlay=$("#overlay");
        if($overlay)
        {
            $("#photo").animate({
                opacity: "0",
                transform: "scale(0)"
            }, 800, function(){
                $("#overlay").remove();
            });
        }
    });

    $("html").keyup(function(e) {
        var $overlay=$("#overlay");
        if (e.keyCode == 27 && $overlay) { // escape key maps to keycode `27`
            $("#photo").animate({
                    opacity: "0",
                    transform: "scale(0)"
                }, 800, function(){
                    $("#overlay").remove();
                });
        }
   });

    $(".img").click(function(){
        var img_source=$(this).attr('src'); 
    	// add icons
        $icons=$('<i class="fa fa-chevron-left" aria-hidden="true"></i><i class="fa fa-chevron-right" aria-hidden="true"></i>');

        $img=$("<img src='"+img_source+"'>").css('opacity',0).load(display);

    });

    $(".gallery-img").click(function(e){
        e.preventDefault();
        e.stopImmediatePropagation();

        //cap=$(this).children(".img-caption").text();
        
        let old_img_source=$(this).children('img').attr('src');
        let new_img_source= old_img_source.replace(/thumbnail/,'big');
        //console.log(new_img_source);
        $img=$("<img src='"+new_img_source+"'>").css('opacity',0).load(display);

        
    });

    function display(){
		// add overlay
		$('<div id="overlay"><div id="photo"></div></div>').prependTo('body');
		// select photo div
		var $photoDiv = $('#photo');
		//add to the #photo div
        $photoDiv.append($img);	

        if(typeof $icons !== 'undefined')
        {
            $photoDiv.append($icons);
        }

        // if(typeof cap !== 'undefined')
        // {
        //     console.log(cap);
        //     $('#caption').text(cap);
        // }
        
        var aspect=($img.outerHeight()/$img.outerWidth());
        fixSize($img,aspect);

        $photoDiv.css('margin-left',(($(window).outerWidth()-$photoDiv.outerWidth())/2));
        $photoDiv.css('margin-top',(($(window).outerHeight()-$photoDiv.outerHeight())/2));

    	//fade in new image
		$img.animate({opacity: 1}, 800);
    }
    function fixSize(img, aspect)
    {
        var flag=0;
        if(img.outerHeight()>=$(window).outerHeight())
        {
            img.css("height",(0.95*$(window).outerHeight()));
            img.css("width",(img.outerHeight()/aspect));
            flag=1;
        }
        if(img.outerWidth()>=$(window).outerWidth())
        {
            img.css("width",(0.95*$(window).outerWidth()));
            img.css("height",(aspect*img.outerWidth()));
            flag=1;
        }

        if(flag==1)
        {
            fixSize(img,aspect);
        }
        return;
    }
});
