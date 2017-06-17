@extends('base')
@section('meta')
    <meta name="description" content="{{$tutorial->palabras_clave}}">
    <meta property="og:title" content="{{$tutorial->titulo}}"/>
    <meta property="og:description" content="{{$tutorial->descripcion}}"/>
    <meta property="og:image" content="{{url('/img/darwindeveloper.png')}}"/>
@endsection
@section('title', $tutorial->titulo)


@section('content-left')
    <div class="list-group">
        <a href="#" class="list-group-item active" style="text-transform: uppercase">
            {{$tutorial->subcategoria}}
        </a>
        @foreach($tutoriales as $tu)
            <a href="{{url('tutorial/'.$tu->id.'/'.urlencode(strtolower($tu->titulo)))}}"
               class="list-group-item">{{$tu->titulo}}</a>
        @endforeach

    </div>

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
        <br>

      <span><i class="fa fa-calendar"></i> {{$tutorial->created_at}}
          , Publicado por Darwin Morocho Rocha</span><br>

        {!! $tutorial->html  !!}

        @if($visto)
            <hr>
            <button id="btn-ok" class="btn btn-default btn-lg"><i class="fa fa-check"></i> Tutorial guardado en
                tu perfil
            </button>
        @else
            <hr>
            <button id="btn-ok" class="btn btn-default btn-lg" style="display: none;"><i
                        class="fa fa-check"></i> Tutorial guardado en tu perfil
            </button>
            <button onclick="guardar({{$tutorial->id}})" id="btn-save" class="btn btn-success btn-lg">Guardar
                este Tutorial en tu perfil
            </button>
        @endif
        <hr>
        <h5 style="font-size: 30px; text-align: center; font-family: 'Segoe Script'">No olvides dejar tu comentario</h5>

        <div id="disqus_thread"></div>


    </div>


    <div class="modal fade cart-modal" id="modal-info">
        <div class="modal-dialog modal-sm">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3><i class="fa fa-info-circle"></i> Información</h3>
                </div>
                <!--Body-->
                <div class="modal-body text-center">

                    <p id="text-info"></p>
                </div>

            </div>
            <!--/.Content-->
        </div>

    </div>




    <div id="modal-loading" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">

                <div class="modal-body text-center">
                    <img src="{{asset('img/loading.gif')}}" alt="">

                    <p>Procesando petición...</p>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection


@section('scripts')

    <script>
        $(function () {
            $('#a-tutoriales').addClass('active');
        });

        function guardar(id) {
            @if(Auth::guest())
             $('#modal-info').modal('show');
            $('#text-info').html('Debes iniciar sesión para poder realizar esta acción');

            @else
             $.ajax({
                url: '{{url('guardar-tutorial')}}',
                data: 'tutorial_id=' + id + '&_token={{csrf_token()}}',
                type: 'POST',
                success: function (data) {
                    $('#modal-loading').modal('hide');
                    if ($.trim(data) === 'exito') {
                        $('#btn-save').hide();
                        $('#btn-ok').show();
                    } else {
                        alert(data);
                    }
                }

            });
            @endif




        }
    </script>
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


