@foreach($news as $new)
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