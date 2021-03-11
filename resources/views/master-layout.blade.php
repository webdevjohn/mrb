<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>@yield('title')</title>   
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}">
 
    <!-- media player styles -->
    <link media="screen" type="text/css" rel="stylesheet" href="{{ asset('css/360player.css') }}">
    <link media="screen" type="text/css" rel="stylesheet" href="{{ asset('css/360player-visualization.css') }}">
    
    <!-- Javascript -->
    <script src="{{ asset('js/app.js')}}"></script>  
    <script src="{{ asset('js/berniecode-animator.js')}}"></script>  
    <script src="{{ asset('js/soundmanager2.js')}}"></script>  
    <script src="{{ asset('js/360player.js')}}"></script>  

    {{-- <script>
        soundManager.setup({
          // path to directory containing SM2 SWF
            url: "http://localhost/mrb2/public/swf"
        });
    </script> --}}
</head>   
    <body>
        <div id="colour-strip"></div>
        
        @include('_partials.default-app-bar') 

        @yield('content')
     
        <footer id="page-footer">
            <div class="wrapper">  
            </div>
        </footer>

        <div id="basket-con">
            <a href="{{ route('basket.index') }}" id="basket-link" class="icon-tracks">
                <strong id="basket-counter"></strong>Tracks</a>
        </div>


        <script>
            (function() {
       
                // load the basket counters
                updateTrackBasketCounter(false);
                                
                // add track to basket via AJAX
                $(document).on("click",".btn-add-track",function(e){
                    var thisa = $(this);
                    var href = $(this).attr('href');

                    if (thisa.text() == "In Basket" ) {
                        return false;
                    } else {
                        addContentToBasket(thisa, href, 'trackBasket');                                                            
                    }
                    // prevent the default action from the anchor link
                    return false;
                });
   
                function updateTrackBasketCounter(animate) {
                    var basket = $('#basket-con');
                    var basketLink = $('#basket-link');

                    $.ajax({
                        url: '{{ URL::route('basket.qty') }}',
                        type: 'GET',
                        success: function(response)
                        {
                            showBasketCounter(response, basket, basketLink, animate);                                                
                            $('#basket-counter').html(response);                         
                        }
                    });
                }   
  
                function showBasketCounter(response, basket, basketLink, animate) {                    
                    if (response > 0 ) {
                        basket.show();                                      
                        basketLink.css('visibility', 'visible'); 
                    } else {
                        basketLink.hide();
                    }

                    if (animate == true){
                        basketLink.fadeOut("slow").fadeIn("slow");                           
                    }
                }


                // make the AJAX request to add the item to the basket.
                function addContentToBasket(thisa, href, basketName) {
                    $.ajax({
                        type: "POST",
                        url: href,
                        data: {
                            '_token': '{!! csrf_token() !!}'
                        }
                    }).done(function(msg) {         
                        //console.log(msg);                     
                        thisa.fadeOut("slow").fadeIn("slow");
                        thisa.text("In Basket");
                        thisa.addClass("track-added");

                        if (basketName == 'trackBasket') {
                            updateTrackBasketCounter(true);
                        }
                    });                                    
                }


                $(document).on("click",".btn-play-track",function(e){
                  
                    var thisa = $(this);
                    var trackId = thisa.data("track-id");
                    var playing = thisa.data("playing");
                   
                    if (playing === false) 
                    {
                        $.ajax
                        ({
                            type: "POST",
                            url: "http://localhost/mrb2/public/tracks/"+trackId+"/played",                      
                            data: {
                                '_token': '{!! csrf_token() !!}'
                        }
                        }).done(function(msg) {                              
                            thisa.data("playing", "true");  
                        });       
                    }  
                });

            })(); // document ready

        </script>
    </body>
 </html>