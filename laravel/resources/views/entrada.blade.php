@extends('curso')

@section('meta')
    <meta name="description" content="{{$entrada->palabras_clave}}">
    <meta property="og:title"  content="{{$curso->id.' - '.$entrada->titulo}}" />
    <meta property="og:description"  content="{{$entrada->palabras_clave}}" />
    <meta property="og:image" content="{{url('/img/darwindeveloper.png')}}" />
@endsection

@section('title',$curso->id.' - '.$entrada->titulo)

@section('content-entrada')
   <div class="dsmr-card">
       <small style="color: #00c0ef;">{{$capitulo->nombre}} <i class="fa fa-arrow-right"></i></small>
       <h2 style="padding: 0; margin: 0; color: #00A9D5;">{{$entrada->titulo}}</h2><br>
       {!!$entrada->html!!}


               <!-- dd-index2 -->
       <ins class="adsbygoogle"
            style="display:block"
            data-ad-client="ca-pub-7777765013946493"
            data-ad-slot="8312654161"
            data-ad-format="auto"></ins>
       <script>
           (adsbygoogle = window.adsbygoogle || []).push({});
       </script> <br>
       <h5 style="font-size: 30px; text-align: center; font-family: 'Segoe Script'">No olvides dejar tu comentario</h5>
       <div id="disqus_thread"></div>
   </div>
@endsection

@section('scripts2')

    <script>
        $(function(){
            $('#collapse'+'{{$capitulo->id}}').collapse();
        });
    </script>
    <script id="dsq-count-scr" src="darwindeveloper-com.disqus.com/count.js" async></script>
    <script>

        var PAGE_URL = window.location.href;
        var title = $(document).find("title").text();

        var disqus_config = function () {
            this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
            this.page.identifier = title; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };

        (function () { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = '//darwindeveloper-com.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
@endsection