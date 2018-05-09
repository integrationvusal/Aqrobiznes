@extends('layouts.main')

@section('title', $title )

@section('content')
    <section class="single padding50">
        <div class="container">

            @widget('BlockWidget')

            <!-- Tab panes -->
            <div class="tab-content">

                <div role="tabpanel" class="tab-pane active" id="author">
                    <div class="author-block">
                        <div class="row">
                            <div class="col-md-8">
                                <img src="{{asset('upload/news/originals/'.$img)}}" class="interlocutor" alt="">
                                <h3 class="mb20 text-bold">{{$title}}</h3>
                                <div class="date mb20"><i class="fa fa-clock-o" aria-hidden="true"></i>{{$time}}</div>

                                {!!$content!!}

                                <hr class="clear"/>
                                
                                <div class="fb-share-button" data-href="{{url()->full()}}" data-layout="box_count" data-size="small" data-mobile-iframe="true">
                                  <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->full())}}%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore"></a>
                                </div>
                                <a href="{{ $settings['facebook'] }}" class="fa sosial-bg fa-facebook"></a>
                                <a href="{{ $settings['youtube'] }}" class="fa sosial-bg fa-youtube"></a>
                                <a href="https://api.whatsapp.com/send?phone={{ $settings['whatsapp'] }}&text={{$title}} - {{strip_tags($content)}}" class="fa sosial-bg fa-whatsapp"></a>

                            </div>
                            <div class="col-md-4">
                                <div class="other-news">DİGƏR KÖŞƏ YAZILARI</div>
                                @foreach($clauses as $claus)
                                    <div class="media">
                                        <div class="media-left media-top">
                                            <a href="{{route($claus['type'], $claus['sef'])}}"><img class="media-object" src="{{asset('upload/news/thumbs/'.$claus['img'])}}" class="img-responsive img-rounded" alt="{{$claus['title']}}">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <a href="{{route($claus['type'], $claus['sef'])}}"><p class="media-heading text-bold">{{$claus['title']}}</p></a>
                                            <div class="date mb20"><i class="fa fa-clock-o" aria-hidden="true"></i>{{$claus['time']}}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>


@endsection
