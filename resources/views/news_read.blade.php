@extends('layouts.main')

@section('title', $title )

@section('content')

     <section class="single padding50">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="main-title mb20">
                        <span>{{$title}}</span>
                    </div>
                    <div class="clear"></div>
                    <div class="date mb20">
                        <i class="fa fa-clock-o" aria-hidden="true"></i>{{$time}}
                        <div class="pull-right"><i class="fa fa-eye" aria-hidden="true"></i>{{$counter}}</div>
                    </div>
                    @if($img)
                        <img src="{{asset('upload/news/originals/'.$img)}}" alt="{{$title}}" class="mb20 img-responsive content-img"/>
                    @endif
                    {!! $content !!}
                    <hr>

        					<div class="fb-share-button" data-href="{{url()->full()}}" data-layout="box_count" data-size="small" data-mobile-iframe="true">
        						<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->full())}}%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore"></a>
        					</div>
                  <a href="{{ $settings['facebook'] }}" class="fa sosial-bg fa-facebook"></a>
        					<a href="{{ $settings['youtube'] }}" class="fa sosial-bg fa-youtube"></a>
        					<a href="https://api.whatsapp.com/send?phone={{ $settings['whatsapp'] }}&text={{$title}} - {{strip_tags($content)}}" class="fa sosial-bg fa-whatsapp"></a>

                </div>
                <div class="col-md-4">

                    <div class="other-news @if($menu) category @endif">@if($menu) {{$menu}} XƏBƏRLƏRİ @else XƏBƏRLƏR @endif</div>

                    <div class="clear"></div>
                    @foreach($news as $new)
                        <div class="media">
                            <div class="media-left media-top">
                                <a href="{{route($menu?'news_read':($new['type'] == 'news'?'news_read':$new['type']), $new['sef'])}}"><img class="media-object" src="{{asset('upload/news/thumbs/'.$new['img'])}}" class="img-responsive img-rounded" alt="{{$new['title']}}">
                                </a>
                            </div>
                            <div class="media-body">
                                <a href="{{route($menu?'news_read':($new['type'] == 'news'?'news_read':$new['type']), $new['sef'])}}"><p class="media-heading text-bold">{{$new['title']}}</p></a>
                                <div class="date mb20"><i class="fa fa-clock-o" aria-hidden="true"></i>{{$new['time']}}</div>
                            </div>
                        </div>
                    @endforeach

                    <div class="row load-to">
						<div class="col-xs-12">
							<button class="load-more lent" accesskey="{{$lent}}">Daha çox</button>
						</div>
					</div>

                </div>
            </div>
        </div>
    </section>


@endsection
