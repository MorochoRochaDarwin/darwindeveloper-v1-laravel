@extends('base')

@section('title','Tutoriales, cursos y libros de '.$lenguaje)

@section('meta')
    <meta name="description"
          charset="Cursos, tutoriales, libros y paginas web recomendadas para el estudio de {{$lenguaje}}">
@endsection


@section('content-pu')


    <!-- dd-index1 -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-7777765013946493"
         data-ad-slot="6835920968"
         data-ad-format="auto"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
    <!-- dd-index2 -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-7777765013946493"
         data-ad-slot="8312654161"
         data-ad-format="auto"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
    <br>
@endsection

@section('content')
    <div class="dsmr-card">
        {!! $webs !!}

        <hr>
        <h5 style="font-size: 30px; text-align: center; font-family: 'Segoe Script'">No olvides dejar tu comentario</h5>

        <div id="disqus_thread"></div>
    </div>
@endsection


@section('scripts')
    <script id="dsq-count-scr" src="//http-darwindeveloper-com.disqus.com/count.js" async></script>
    <script>

        var PAGE_URL = window.location.href;
        var title = $(document).find("title").text();

        var disqus_config = function () {
            this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
            this.page.identifier = title; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };

        (function () { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = '//http-darwindeveloper-com.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
@endsection


