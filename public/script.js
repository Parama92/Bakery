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
       /* $("#fill").text(text);
        $("#added-to-cart").slideDown(1000);
        setTimeout(function(){
            $("#added-to-cart").slideUp(1000);
        },2000);*/ 
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

    $(".remove").click(function(){
        node=$(this).next('input');
        info=node.val();
        total_sum=$('#sum').text();

        $.ajax({
            type:"GET",
            url:"data_handlers/cart_remove.php",
            data: 'info='+info,
            success: function(sum)
            {
                modify(node,(total_sum-sum));
            }
        });
    });

    function modify(node,sum)
    {
        node.parent().parent().remove();
        
        if(sum==0)
        {
            $('#checkout').remove();
        }
        else
        {
            $('#sum').text(sum);
        }
    }
});
