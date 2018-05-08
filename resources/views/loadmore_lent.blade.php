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