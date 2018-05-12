@extends('layouts.main')

@section('title', $title)

@section('script')
    <script>var _wholes_data = JSON.parse('{!!json_encode($wholesales, JSON_UNESCAPED_UNICODE )!!}');</script>
    <script src="{{asset('js/wholesale.js')}}"></script>
@endsection

@section('content')

   <section  class="padding50" id="corusel">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-sm-6">
					<div class="main-title">
						<span>XƏBƏRLƏR</span>
					</div>
					<div class="clear"></div>
					<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
						<!-- Indicators -->
						<ol class="carousel-indicators">
							<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
							<li data-target="#carousel-example-generic" data-slide-to="1"></li>
							<li data-target="#carousel-example-generic" data-slide-to="2"></li>
							<li data-target="#carousel-example-generic" data-slide-to="3"></li>
						</ol>

						<!-- Wrapper for slides -->
						<div class="carousel-inner" role="listbox">
						   @foreach($news as $new)
							<div class="item @if($loop->first) active @endif">
								{{--<img src="{{asset('upload/news/originals/'.$new['img'])}}" alt="{{$new['title']}}" alt="...">--}}
								<img src="{{route('resize', ['url'=>base64_encode('upload/news/originals/'.$new['img']), 'width'=>750, 'height'=>300] )}}" alt="{{$new['title']}}"/>
								<div class="carousel-caption">
									<a href="{{route('news_read', $new['sef'])}}"><h3>{{$new['title']}}</h3></a>
									<p><i class="fa fa-clock-o" aria-hidden="true"></i>
									@if($new['is_today']) Bu gün
                                            @else {{$new['time']}}  @endif
									</p>
								</div>
							</div>
						  @endforeach
							
												
						</div>

						<!-- Controls -->
						<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
						</a>
					</div>
				</div>
				
				<div class="col-md-4 col-sm-6">
					<div class="main-title">
						<a href="{{route('photodays')}}">
						    <span>GÜNÜN FOTOSU</span>
						</a>
					</div>
					<div class="clear"></div>
					<div class="info-content">
						<a href="{{route('dayphoto', urlencode($dayphoto[0]['sef']))}}" class="hvr-sweep-to-top" style="width:100%;">
							<div class="info-hover">
								<h3>{{ $dayphoto[0]['title'] }}</h3>
							</div>
							<div class="day-photo">
								{{--<img src="{{asset('upload/news/originals/'.$dayphoto[0]['img'])}}" class="img-responsive">--}}
								<img src="{{route('resize', ['url'=>base64_encode('upload/news/originals/'.$dayphoto[0]['img']), 'width'=>360, 'height'=>300] )}}" class="img-responsive">
							</div>
						</a>
					</div>
											
				</div>
			</div>
		</div>
	</section>

    <section id="healthy" class="padding50">
		<div class="container">
			<div class="row slideanim">
				<div class="col-md-4 col-sm-6 col-xs-12">
					<div class="main-title">
						<a href="{{route('category', 'saghlam-yasha')}}"><span>SAĞLAM YAŞA</span></a>
					</div>
					<div class="clear"></div>
						<div class="info-content">
						<a href="{{route('news_read', $healthy['sef'])}}" class="hvr-sweep-to-top" style="width:100%;">
							<div class="info-hover">
								<h3>{{$healthy['title']}}</h3>
							</div>
							<div class="day-photo">
								<img src="{{asset('upload/news/originals/'.$healthy['img'])}}" class="img-responsive">
							</div>
						</a>
					</div>
										
				</div>
				@if($interview)
			
    				<div class="col-md-4 col-sm-6 col-xs-12">
    					<div class="main-title">
    					    
    					<a href="{{route('interview_list')}}"><span>BİZNES LAYİHƏLƏRİ</span></a>
    					</div>
    					<div class="clear"></div>
    					<div class="info-content">
						<a @if($interview['publish']== 1 )
    						href="{{route('interview', $interview['sef'])}}"
    						@endif class="hvr-sweep-to-top" style="width:100%;">
							<div class="info-hover">
								<h3>{{$interview['title']}}</h3>
							</div>
							<div class="day-photo">
								<img src="{{asset('upload/news/originals/'.$interview['img'])}}" class="img-responsive">
							</div>
						</a>
					</div>
    										
    				</div>
				@endif
				<div class="col-md-4 col-sm-6 col-xs-12">
					<div class="main-title">
					<a href="{{route('clauses_list')}}"><span>KÖŞƏ YAZILARI</span></a>
					</div>
					<div class="clear"></div>
					<div class="info-content">
						<a href="{{route('clauses', $clauses['sef'])}}"
    						class="hvr-sweep-to-top">
							<div class="info-hover">
								<h3>{{ $clauses['title'] }}</h3>
							</div>
							<div class="day-photo">
								<img src="{{asset('upload/news/originals/'.$clauses['img'])}}" class="img-responsive">
							</div>
						</a>
					</div>
									
				</div>			
			</div>		
		</div>
		
	</section>
	<section id="store-sale" class="padding50">
		<div class="container">
			<div class="row slideanim">
				<div class="col-sm-12">
					<div class="main-title">
						<a href="{{route('wholesales')}}"><span>BAZAR QİYMƏTLƏRİ</span></a>
					</div>
					<div class="clear"></div>
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<tr>
								<th>Tarix</th>
								<th>Məhsulun adı</th>
								<th>Məhsulun növü</th>
								<th>Ölçü vahidi</th>
								<th>Hansı bazar</th>
								<th>Qiyməti</th>
							</tr>
							@foreach($wholesales as $date=>$wholesale)
    							<tr class="wholesale">
    								<form action="">
    									<td class="whole-date">{{$date}}</td>
    									<td>
    										<select class="form-control product">
    											<option value="">Məhsulu seçin</option>
    											@foreach($wholesale as $product=>$w)
    											    <option value="{{$product}}">{{$product}}</option>
    											@endforeach
    										</select>
    									</td>
    									<td>
    										<select class="form-control types">
    										</select>
    									</td>
    									<td>
    										<select class="form-control measures">
    										</select>
    									</td>
    									<td>
    										<select class="form-control markets">
    										</select>
    									</td>
    									<td><span class="whole-price">0.00</span> AZN</td>
    								</form>
    								
    							</tr>
                            @endforeach	
							
						</table>
					</div>
					<!-- <a href=""><img src="img/market-sale.png" alt="" class="mb20"></a> -->					
				</div>
			</div>			
		</div>
	</section>

    <section class="padding50" id="alqi-satqi">
        <div class="container">
            <div class="main-title">
                <a target="_blank" href="//aqromarket.aqrobiznes.az"><span>ALQI-SATQI</span></a>
            </div>
            <div class="clear"></div>
            <div class="owl-carousel owl-theme slideanim">

                @foreach($products as $product)
                    <div class="item info-content">
                        <a href="//aqromarket.aqrobiznes.az/pages/elan/{{$product->elan_ad}}" target="_blank" class="hvr-shutter-out-horizontal">
                            <div class="info-hover">
                                <h3><i class="fa fa-search" aria-hidden="true"></i></h3>
                            </div>
                            <div class="product">
                                <img src="http://www.aqromarket.aqrobiznes.az/{{$product->picname}}" alt="" class="text-center">
                                <h4>{{$product->elan_mezmun}}</h4>
                                <div class="product-info">
                                    <h4 class="pull-left text-bold">{{$product->price}} AZN</h4>
                                    <p class="pull-right">{{$product->elan_tarix}}</p>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </a>        
                    </div>  
                @endforeach

            </div>

        </div>
    </section>
    
    
    <section id="agrocalendar" class="padding50">
		<div class="container">
			<div class="row slideanim">
				<div class="col-sm-6">
					<div class="main-title">
						<a href="{{route('agrocalendar')}}"><span>AQROTƏQVİM</span></a>
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
				<div class="col-sm-6">
					<div class="main-title">
						<a href="{{route('questions')}}"><span>BİZDƏN SORUŞURLAR</span></a>
					</div>
					<div class="clear"></div>
					<div class="questions">
						<dl class="dl-horizontal">
						    @foreach($questions as $question)
    							<dt>Sual:</dt>
    							<dd>
    								{!!$question['question']!!}
    							</dd>
    							<dt>Cavab:</dt>
    							<dd>
    								{!!$question['answer']!!}
    							</dd>
							@endforeach
						</dl>			
					</div>
					<form action="">
						<div class="row">								
							<div class="col-xs-12">
								<div class="input-group">
									<input type="text" class="form-control input-lg" placeholder="Sual">
									<span class="input-group-btn">
										<button class="btn questions btn-default btn-lg" type="button">Göndər</button>
									</span>
								</div>
							</div>
						</div>
					</form>						
				</div>
			</div>			
		</div>
	</section>
    
 <section id="agro-techno-video" class="padding50">
		<div class="container">
			<div class="row slideanim">
				<div class="col-md-5">
					<div class="main-title">
						<a href="{{route('category', 'aqromeslehet')}}"><span>AQROMƏSLƏHƏT</span></a>
					</div>
					<div class="clear"></div>
					<img src="{{asset('img/agrom1.jpg')}}" alt="" class="img-responsive">
				</div>
				<div class="col-md-3">
					<div class="main-title">
						<a href="{{route('category', 'texnologi̇ya')}}"><span>TEXNOLOGİYA</span></a>
					</div>
					<div class="clear"></div>
					<img src="{{asset('img/techno1.jpg')}}" alt="" class="img-responsive">
				</div>
				<div class="col-md-4">
					<div class="main-title">
						<a href="{{route('videos')}}"><span>VİDEOTƏLİM</span></a>
					</div>
					<div class="clear"></div>
					{!!Helper::youtube($video['link'])!!}
					<div class="over-text">{{$video['title']}}</div>
				</div>
			</div>
		</div>			
			
	</section>

@endsection
