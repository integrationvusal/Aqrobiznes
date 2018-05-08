@extends('layouts.main')

@section('title', $title )

@section('content')
    <section class="single padding50">
        <div class="container">         
            <div class="contact">   
                <div class="main-title mb20">
                    <span>{{$title}}</span>
                </div>
                <div class="clear"></div>           
                <div class="row photodays">   
                    @foreach($videos as $video)
                        <div class="col-sm-12 col-md-3">
    						{!!Helper::youtube($video['link'])!!}
					        <div class="over-text">{{$video['title']}}</div>
    					</div>
                    @endforeach
                </div>                  
            </div>              
        </div>
    </section>

@endsection