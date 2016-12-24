(function ($) {
    $(function () {

        //SCROLL TOP

        $(function () {
            $.scrollUp();
        });

        //FUNCTION RANDOM

        function rand(min, max) {
            return Math.round(Math.random() * (max - min)) + min;
        }

        var str = [
        "100% Оригинальная продукция!",
        "Бесплатная доставка по Украине!",
        "Возврат товара в течении 14 дней!",
        "Дешевле только даром!"

        ];

        setInterval(function () {
            $('.layout-left').text(str[rand(0, str.length)]);
        }, 4000);

        //CALLBACK

            $('.back-call').click(function() {
                $('#callBackBlock').slideToggle(800);
            })
        

        //SEARCH WIDTH
        
        $('.search').focus(function () {
            $('.search').css({
                transition: "all 0.5s",
                width: "100%"
            })
        });
        $('.search').focusout(function () {
            $('.search').css({
                transition: "all 0.5s",
                width: "70%",
            })
        });

        // Registration

        $("#chbox").on("click", function () {
            if ($(this).is(":checked")) {
                $('.qwerty').slideDown(500);
                $('.reg').val('Зарегистрироваться');
                $('.reg').attr( 'name', 'reg' );
            }
            else {
                $('.qwerty').slideUp(500);
                $('.reg').val('Войти');
                $('.reg').attr( 'name', 'signin' );
            }
        })

        //    Tabs

        $(".tab_item").not(":first").hide();
        $(".wrapper .tab").click(function () {
            $(".wrapper .tab").removeClass("active").eq($(this).index()).addClass("active");
            $(".tab_item").hide().eq($(this).index()).fadeIn()
        }).eq(0).addClass("active");

    // CAROUFRIDSEL

    $(function() {
        $('#thumbs').carouFredSel({
            synchronise: ['#images', false, true],
            auto: false,
            width: 450,
            items: {
                visible: 3,
                start: -1
            },
            scroll: {
                onBefore: function( data ) {
                    data.items.old.eq(1).removeClass('selected');
                    data.items.visible.eq(1).addClass('selected');
                }
            },
            prev: '#prev',
            next: '#next'
        });

        $('#images').carouFredSel({
            auto: false,
            items: 1,
            scroll: {
                fx: 'fade'
            }
        });

        $('#thumbs img').click(function() {
            $('#thumbs').trigger( 'slideTo', [this, -1] );
        });
        $('#thumbs img:eq(1)').addClass('selected');
    });


//размер картинок

if ($('.widthImg').css('width')>$('.widthImg').css('height')) {
    $('.widthImg').css('width', '100%');
}
else{
    $('.widthImg').css('height', '100%')
}

//отзывы

$('.comment').click(function() {
    $('.row-comment').slideToggle();
})


//sliderPrice

$(function() {
    $( "#slider-range" ).slider({
      step: 50,
      range: true,
      min: 50,
      max: 50000,
      values: [ 1000, 10000 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( ui.values[ 0 ] );
        $( "#amount_1" ).val( ui.values[ 1 ] );
    }
});
    $( "#amount" ).val( $( "#slider-range" ).slider( "values", 0 ) );
    $( "#amount_1" ).val( $( "#slider-range" ).slider( "values", 1 ) );

        // Изменение местоположения ползунка при вводиде данных в первый элемент input
        $("input#amount").change(function(){
            var value1=$("input#amount").val();
            var value2=$("input#amount_1").val();
            if(parseInt(value1) > parseInt(value2)){
                value1 = value2;
                $("input#amount").val(value1);
            }
            $("#slider-range").slider("values",0,value1);   
        });

          // Изменение местоположения ползунка при вводиде данных в второй элемент input    
          $("input#amount_1").change(function(){
            var value1=$("input#amount").val();
            var value2=$("input#amount_1").val();

            if(parseInt(value1) > parseInt(value2)){
                value2 = value1;
                $("input#amount_1").val(value2);
            }
            $("#slider-range").slider("values",1,value2);
        });

          // фильтрация ввода в поля
          jQuery('#amount, #amount_1').keypress(function(event){
            var key, keyChar;
            if(!event) var event = window.event;

            if (event.keyCode) key = event.keyCode;
            else if(event.which) key = event.which;
            
            if(key==null || key==0 || key==8 || key==13 || key==9 || key==46 || key==37 || key==39 ) return true;
            keyChar=String.fromCharCode(key);

            if(!/\d/.test(keyChar)) return false;
            
        });

      });


$('#filterPrice').click(function() {
    var min=$('#amount').val();
    var max=$('#amount_1').val();
    document.location="index.php?page=2&max="+max+"&min="+min;
})


});
})(jQuery)