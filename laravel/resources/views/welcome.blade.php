@extends('base')

@section('title','Darwin Developer Inicio')

@section('meta')
    <meta name="description"
          charset="Cursos y tutoriales de PHP, android, java, laravel, django, html, css, jquery y javascript">
@endsection


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.transitions.css">

    <style>
        .serviceBox {
            text-align: center;
            margin: 0 -15px;
        }

        .serviceBox img {
            width: 100%;
            height: auto;
        }

        .serviceBox .service-content {
            position: relative;
            background: #0099cc;
            color: #fff;
            padding: 50px 30px 30px;
        }

        .serviceBox .service-icon {
            display: block;
            width: 70px;
            height: 70px;
            background: #fff;
            border-radius: 10px;
            position: absolute;
            top: -35px;
            left: 0;
            right: 0;
            margin: auto;
            transform: rotate(45deg);
        }

        .serviceBox .service-icon i {
            font-size: 30px;
            line-height: 70px;
            color: #0099cc;
            transform: rotate(-45deg);
        }

        .serviceBox .title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .serviceBox .description {
            font-size: 14px;
            line-height: 25px;
            margin-bottom: 20px;
        }

        .serviceBox .read-more {
            display: inline-block;
            padding: 7px 20px;
            border: 1px solid #fff;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            color: #fff;
            background: #0099cc;
            text-transform: capitalize;
            transition: all 0.5s ease 0s;
        }

        .serviceBox .read-more:hover {
            color: #0099cc;
            background: #fff;
            text-decoration: none;
        }

        .serviceBox.middle .service-content {
            padding: 30px 30px 50px;
        }

        .serviceBox.middle .service-icon {
            bottom: -35px;
            top: auto;
        }

        @media only screen and (max-width: 990px) {
            .serviceBox .title {
                font-size: 17px;
            }
        }

        @media only screen and (max-width: 767px) {
            .serviceBox {
                margin: 0 0 30px 0;
            }
        }

        .testimonial {
            border-left: 3px solid #0099cc;
            padding: 60px 0 60px 255px;
            position: relative
        }

        .testimonial:before,
        .testimonial:after {
            content: "";
            width: 320px;
            height: 55px;
            border-right: 3px solid #0099cc;
            position: absolute;
            left: 0;
        }

        .testimonial:before {
            border-top: 3px solid #0099cc;
            top: 0;
        }

        .testimonial:after {
            border-bottom: 3px solid #0099cc;
            bottom: 0;
        }

        .testimonial .pic {
            width: 190px;
            height: auto;
            position: absolute;
            top: 60px;
            left: 40px;
        }

        .testimonial .pic img {
            width: 100%;
            height: auto;
        }

        .testimonial .description {
            font-size: 14px;
            color: #7a7e82;
            line-height: 27px;
            position: relative;
        }



        .testimonial .testimonial-title {
            font-size: 22px;
            font-weight: 800;
            color: #22272c;
            text-transform: capitalize;
        }

        .testimonial .post {
            display: block;
            font-size: 15px;
            font-weight: 700;
            color: #0099cc;
            margin-top: 0px;
            margin-bottom: 10px;
        }

        .owl-theme .owl-controls {
            text-align: right;
            margin-top: 30px;
        }

        .owl-theme .owl-controls .owl-buttons div {
            background: #0099cc;
            border-radius: 0;
            opacity: 1;
            padding: 5px 10px;
        }

        .owl-prev:before,
        .owl-next:before {
            content: "\f053";
            font-family: 'FontAwesome';
            color: #fff;
        }

        .owl-next:before {
            content: "\f054";
        }

        @media only screen and (max-width: 990px) {
            .testimonial {
                padding: 80px 0 80px 265px;
            }
        }

        @media only screen and (max-width: 767px) {
            .testimonial {
                padding: 0;
                border: none;
            }

            .testimonial:before,
            .testimonial:after {
                border: none;
            }

            .testimonial .pic {
                position: relative;
                top: 0;
                left: 0;
            }

            .testimonial .description {
                margin-top: 15px;
            }

            .testimonial .description:before {
                content: "";
            }
        }
    </style>
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
@endsection()


@section('content')

    <div class="container-fluid">
      <div class="row">
          <div class="col-md-9 col-lg-9" style="padding-left: 0;">

              @if(count($tutoriales)>0)

                  @foreach($tutoriales as $tutorial)


                      <div class="testimonial card">
                          <div class="pic">
                              <img src="{{asset($tutorial->img)}}" alt="{{$tutorial->titulo}}">
                          </div>
                          <div class="testimonial-content" style="padding-right: 10px;">

                              <a href="{{url('/tutorial/'.$tutorial->id.'/'.urlencode(strtolower($tutorial->titulo)))}}" class="testimonial-title"> {{$tutorial->titulo}}
                                  <small class="post">{{$tutorial->updated_at}}</small>
                              </a>

                              <p class="description" style="text-align: justify; color: black;">
                                  {{$tutorial->descripcion}}
                              </p>


                          </div>
                      </div>



                  @endforeach
                  <div class="text-center">
                      {{ $tutoriales->links() }}
                  </div>

              @endif
          </div>
          <div class="col-md-3 col-lg-3" style="padding: 0px 5px;">

              @if(count($cursos)>0)

                  @foreach($cursos as $curso)



                      <div class="card col-sm-6 col-md-12" style="padding: 0;">
                          <a class="img-card"
                             href="{{url('cursos/'.urlencode($curso->id))}}">
                              <img src="{{asset($curso->img)}}"/>
                          </a>

                          <div class="card-content  text-center" style="padding: 0;">
                              <h4 class="card-title text-center" style=" margin-top: 5px;">
                                  <a href="{{url('cursos/'.urlencode($curso->id))}}">
                                      {{$curso->id}}
                                  </a>
                              </h4>

                              <p class=" text-center">
                                  Ultima Actualización:<br>{{$curso->updated_at}}
                              </p>
                          </div>
                          <div class="card-read-more">
                              <a href="{{url('cursos/'.urlencode($curso->id))}}"
                                 class="btn btn-link btn-block">
                                  Ver Curso
                              </a>
                          </div>
                      </div>




                  @endforeach


              @endif
          </div>
      </div>
        <div class="clearfix"></div>
    </div>




@endsection



@section('scripts')
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>

    <script>
        $(function () {
            $('#a-inicio').addClass('active');

            $("#testimonial-slider").owlCarousel({
                items: 1,
                itemsDesktop: [1000, 2],
                itemsDesktopSmall: [979, 1],
                itemsTablet: [768, 1],
                pagination: false,
                navigation: true,
                slideSpeed: 1000,
                singleItem: true,
                transitionStyle: "goDown",
                navigationText: ["", ""],
                autoPlay: false
            });
        });
    </script>
@endsection