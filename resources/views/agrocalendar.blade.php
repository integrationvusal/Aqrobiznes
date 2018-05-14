@extends('layouts.main')

@section('title', $title )

@section('content')
 
     <section class="single padding50 minh">
        <div class="container">   
            <div class="main-title mb20">
                <span>{{$title}}</span>
            </div>
            <div class="clear"></div>           
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				@foreach($agrocalendar as $agro)
				  <div class="panel panel-default">
					<div class="panel-heading" role="tab" id="heading_{{$loop->index}}">
					  <h4 class="panel-title">
						<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_{{$loop->index}}" aria-expanded="false" aria-controls="collapse_{{$loop->index}}">
						  {{$agro['title']}}
						</a>
						<i class="fa fa-plus fa-action"></i>
					  </h4>
					</div>
					<div id="collapse_{{$loop->index}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading_{{$loop->index}}">
					  <div class="panel-body">{!!$agro['full']!!}</div>
					</div>
				  </div>
			   @endforeach
			</div>             
        </div>
    </section>

@endsection