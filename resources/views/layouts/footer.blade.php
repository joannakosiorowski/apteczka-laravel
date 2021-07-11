<footer class="footer">
    <div class="w-100 clearfix">
        <span class="text-center text-sm-left d-md-inline-block">Copyright © {{ now()->year }}</span>
        <span class="float-none float-sm-right mt-1 mt-sm-0 text-center">Crafted with <i class="fa fa-heart text-danger"></i> by <a href="http://lavalite.org/" class="text-dark" target="_blank"> Joanna Kosiorowski</a></span>
    </div>
</footer>







<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>window.jQuery || document.write('<script src="src/js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
<script src="{{asset('template/plugins/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('template/plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('template/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('template/plugins/screenfull/dist/screenfull.js')}}"></script>
<script src="{{asset('template/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('template/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('template/plugins/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('template/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('template/plugins/jvectormap/jquery-jvectormap.min.js')}}"></script>
<script src="{{asset('template/plugins/jvectormap/tests/assets/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{asset('template/plugins/moment/moment.js')}}"></script>
<script src="{{asset('template/plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script src="{{asset('template/plugins/d3/dist/d3.min.js')}}"></script>
<script src="{{asset('template/plugins/c3/c3.min.js')}}"></script>
<script src="{{asset('template/js/tables.js')}}"></script>
<script src="{{asset('template/js/widgets.js')}}"></script>
<script src="{{asset('template/js/charts.js')}}"></script>
<script src="{{asset('template/dist/js/theme.min.js')}}"></script>


<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script type="text/javascript">
$(document).ready(function(){
$("#datepicker, #datepicker2").datetimepicker({
    format:'YYYY-MM-DD'
})
})
</script>

<script>
(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
e=o.createElement(i);r=o.getElementsByTagName(i)[0];
e.src='https://www.google-analytics.com/analytics.js';
r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
ga('create','UA-XXXXX-X','auto');ga('send','pageview');
</script>

<script>
    setTimeout(function(){
        document.getElementById('testMSG').classList.add("hidden");
    }, 10000); // 10000ms = 10s
</script>
<script>


var Ajax = {

    get: function (url, success, data = null, beforeSend = null) {
      
        $.ajax({

            cache: false,
            url: url,
            type: "GET",
            data: data,
            success: function(response){
                
            App[success](response);
                
            },
            beforeSend: function(){
               
            if(beforeSend)    
            App[beforeSend]();
                
            }


        });
    },

    set: function(data={}, url, success=null) { //set jest do notyfikacji
        $.ajax({
            cache: false,
            url: url,
            type: "GET",
            dataType: "json",
            data: data,
            success: function(response){
                
                if(success)
                App[success](response);
                    
                },

        });
        
    }


};


var App = {

    timestamp: null,

    idsOfNotShownNotifications: [],



    SetReadNotification: function(id) {
        Ajax.set({id:id}, 'ajaxSetReadNotification?fromWebApp=1');
    },

    GetNotShownNotifications: function() { //powidomienia w czasie rzeczywistym bez odswiezania strony , wylapuje niepokazane jeszcze powiadomienia
        Ajax.get('ajaxGetNotShownNotifications?fromWebApp=1&timestamp='+ App.timestamp, 'AfterGetNotShownNotifications'); //request ajaxowy, url stworzony w web.php
        //robi request ajaxowy do url, a url ma metode w controlerze ktora ma petle while nieskonczona, zeby nie uzywac setTimeout
    },

    AfterGetNotShownNotifications: function(response) //callback success, wykona sie tylko jak wykonczy sie petla while i bedzie zwrocony kod json
    {
                //w momencie gdy ktoś zrobi rezerwacje to pojawia się response 
        console.log('to jest res');
        console.log(response);
        var json = JSON.parse(response); //zamania string response na obiekt
        console.log('to jest json');
        console.log(json);
        App.timestamp = json['timestamp'];
        setTimeout(App.GetNotShownNotifications(), 100); //to co chce wykonac, czas po jakim to chce wykonac

        if(jQuery.isEmptyObject(json['notifications']))
        return ;

        $('#app-notification-count').show();
        $('#app-notification-count').removeClass('hidden');

        for(var i = 0; i<=json['notifications'].length - 1; i++)
        {
            App.idsOfNotShownNotifications.push(json['notifications'][i].id );
            $('#app-notification-count').html(parseInt($('#app-notification-count').html())+ 1 );
            $('app-notifications-list').append('<li class="unread_notification"><a href="'+json['notifications'][i].id+'">'+json['notifications'][i].content+'</a></li>');
        }

        App.SetShownNotifications(App.idsOfNotShownNotifications);
        
    },

    SetShownNotifications: function(ids)
    {
        Ajax.set({idsOfNotShownNotifications:ids}, 'ajaxSetShownNotifications?fromWebApp=1');
    }



};

//notyfikacje

$(document).on('click','.unread_notification', function(e) {
    e.preventDefault(); //ta metoda zapobiega po kliknięciu przeniesieniu sie do linku
    $(this).removeClass('unread_notification'); //po kliknieciu sciaga klase i notyfikacja sie juz nie podswietla na niebiesko

    var ncount = parseInt($('#app-notification-count').html()); //pobiera zawartosc spana i zmienia na libczne calkowita

    if(ncount > 0)
    {
        $('#app-notification-count').html(ncount - 1);

        if(ncount == 1)
        $('#app-notification-count').hide();
    }

    var idOfNotification = $(this).children().attr('href');
    $(this).children().removeAttr('href'); //zapobiega przesciu do linku po kliknieciu w odznaczone powiadomienie ,zwroci id

    App.SetReadNotification(idOfNotification);
});




$(function(){ //działa w tle bez przełaowania (document ready w formie funkcji anonimowej)
    App.GetNotShownNotifications(); //metoda do pokazywania sie w czasie rzeczywistym
});

$(document).on('click','.dropdown', function(e) {
    e.stopPropagation();
});

</script>
</body>
</html>
