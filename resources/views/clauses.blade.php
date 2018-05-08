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

                                <a href="#" class="fa sosial-bg fa-facebook"></a>
                                <a href="#" class="fa sosial-bg fa-twitter"></a>
                                <a href="#" class="fa sosial-bg fa-linkedin"></a>
                                <a href="#" class="fa sosial-bg fa-google-plus"></a>
                                <a href="#" class="fa sosial-bg fa-whatsapp"></a>

                                <div id="share"></div>
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