@extends('layouts.main')

@section('title', $title )

@section('content')
    <section id="healthy" class="single padding50">
        <div class="container">         
            <div class="contact">   
                <div class="main-title mb20">
                    <span>{{$title}}</span>
                </div>
                <div class="clear"></div>           
                <div class="row">   
                    @foreach($dayphoto as $dayphotos)
                       	<div class="info-content col-sm-12 col-md-3 photodays">
						<a href="{{route('dayphoto', $dayphotos['sef'])}}" class="hvr-sweep-to-top" style="width:100%;">
							<div class="info-hover">
								<h3>{{$dayphotos['title']}}</h3>
							</div>
							<div class="day-photo">
								<img src="{{asset('upload/news/originals/'.$dayphotos['img'])}}" class="img-responsive">
							</div>
						</a>
					</div> 
                    @endforeach
                </div>                  
            </div>              
        </div>
    </section>

@endsection
