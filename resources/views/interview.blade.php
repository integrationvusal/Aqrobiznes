@extends('layouts.main')

@section('title', $title )

@section('content')
    <section class="single padding50">
        <div class="container">
            
            {{--@widget('BlockWidget')--}}
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="full active"><a href="#interview" aria-controls="interview" role="tab" data-toggle="tab">@lang('custom.blocks.interview_list')</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
   
                <div role="tabpanel" class="tab-pane active" id="interview">
                    <div class="interview-block">                       
                        <div class="row load-to">           
                            @foreach($interviews as $new)
        						<div class="col-xs-12 col-sm-6 col-md-4">
        							<a href="{{route('news_read', $new['sef'])}}">
        								<article>
        									<div class="image-size">
        										<img src="{{asset('upload/news/originals/'.$new['img'])}}" class="img-responsive img-rounded" alt="">
        									</div>
        									<div class="news-content">
        										<div class="news-content-block">
        											<p class="text-gray50 text-bold">{{ $new['title'] }}</p>
        										</div>
        									</div>
        									
        									<div class="date-time">
        										<p class="pull-left">{{$new['time']}}</p>
        										<p class="pull-right"><i class="fa fa-eye" aria-hidden="true"></i>{{$new['counter']}}</p>
        										<div class="clear"></div>
        									</div>
        								</article>
        							</a>
        						</div>
        					@endforeach
                    
                        </div>
                        
                        <div class="row">
    						<div class="col-xs-12">
    							<button class="load-more" data-route="interview">Daha çox <i class="fa fa-spinner fa-spin"></i></button>
    						</div>
    					</div>
                    </div>
                </div>
            </div>
        </div>
        
        
    </section>

@endsection