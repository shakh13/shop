(function(){
    $.fn.anim = function(){
        this.click(function(){

        });
    }
}(jQuery));

$(document).ready(function(){
    $('.button-collapse').sideNav();
    $('.dropdown-profile').dropdown({constrainWidth: false, belowOrigin: true});
    $('.slider').slider({indicators: false});
    $('ul.tabs').tabs();

    $('a#search i').click(function(){
        if ($('#search-p').hasClass('none')){
            $('#search-p').removeClass('none');
            $('#search-p input').focus();
        }
        else {
            $('#search-p').addClass('none');
        }
        return false;
    });

    $('a#close-q').click(function(){
        $('#search-p').addClass('none');
    });


    var desc_index = 0;
    $('#desc_add').click(function(){
        var id = $('#desc_select').val();
        var value = $('#desc_select option:selected').text();


        $('#descriptions').append("<div class='row desc_"+desc_index+"'>"
            +"<div class='col m4'>"+value+"</div>"
            +"<div class='col m7'><input type='hidden' name='Products[description_ids]["+desc_index+"]' value='"+id+"'><input type='text' name='Products[description_contents]["+desc_index+"]'></div>"
            +"<div class='col m1'><a href='#remove' onclick='remove_desc("+desc_index+");'>Remove</a></div> "
            +"</div>");
        desc_index++;
        return false;
    });

    var p_show_index = 0;
        $('#add_p_show').click(function (){
            p_show_index++;
            $('#photos_show').append("<div class='row p3 p_sh_"+p_show_index+"'>" +
                "<input type='file' class='col m11' name='Products[photo][sh_"+p_show_index+"]'>" +
                "<a href='#del_p_show' onclick='delete_p_show("+p_show_index+");'>Удалить</a> " +
                "</div>");

            return false;
        });

    var p_color_index = 0;
    $('#add_p_color').click(function (){

        $('#photos_color').append("<div class='row p_c_"+p_color_index+"'>" +
                "<div class='col m5'><input type='file' name='Products[photo][c_"+p_color_index+"][file]'></div>" +
                "<div class='col m6'><input name='Products[p_color][c_"+p_color_index+"]' placeholder='Цвет'></div>" +
            "<div class='col m1'><a href='#del_p_color' onclick='delete_p_color("+p_color_index+");'>Удалить</a></div> " +
            "</div>");
        p_color_index++;
        return false;
    });

    var p_size_index = 0;
    $('#p_size_add').click(function() {

        $('#p_sizes').append("<div class=\"col m4 row p_s_"+p_size_index+"\">\n" +
            "                <div class=\"col m7\"><input type=\"text\" name=\"Products[size]["+p_size_index+"]\" placeholder=\"Размер\"></div>\n" +
            "                <div class=\"col m5\"><a onclick=\"delete_p_size("+p_size_index+");\" href=\"#del_p_size\">Удалить</a></div>\n" +
            "            </div>");

        $('#p_sizes > .p_s_'+p_size_index+' input').focus();
        p_size_index++;
        return false;
    });


    $('a[href="#favorites"]').click(function(){
        var _this = $(this);
        var id = _this.attr('data-id');

        jQuery.post('?r=products/addtofavorites', {product_id: id},  function (data){
            _this.toggleClass('selected', data['added']);
        });

        return false;
    });

    $('.countcountrol > .plus, .countcountrol > .minus').click(function(){
        var is_plus = $(this).hasClass('plus');

        var price = $('input[name="price"]').val();
        var discount = $('input[name="discount"]').val();
        var dfc = $('input[name="dfc"]').val();

        var count = $('input[name="Basket[count]"]').val();

        count = is_plus ? count*1+1 : count-1.0;

        if (count<1) count = 1;

        var $p = count * price;

        $p = count >= dfc ? $p*(1-discount/100) : $p;

        $('.countcountrol > .count').html(count);
        $('input[name="Basket[count]"]').val(count);

        $('span.price').html($p);
    });

    $('#mybasket .collection-item > label').click(function () {
        var id = $(this).attr('data-id');
        var attr = $('#mybasket .collection-item[data-id='+id+'] > label > input.basket_check')[0].checked;

        $('#mybasket .collection-item[data-id='+id+']').toggleClass('selected', attr);
    });

});

function remove_desc(id) {
    $('#descriptions > .desc_'+id).remove();
    return false;
}

function delete_p_size(id){
    $('#p_sizes > .p_s_'+id).remove();
    return false;
}

function delete_p_color(id){
    $('#photos_color > .p_c_'+id).remove();
    return false;
}

function delete_p_show(id){
    $('#photos_show > .p_sh_'+id).remove();
    return false;
}