@extends('layouts.main')

@section('title', $title )

@section('script')
    <script>var _wholes_data = JSON.parse('{!!json_encode($wholesales, JSON_UNESCAPED_UNICODE )!!}');</script>
    <script src="{{asset('js/wholesale.js')}}"></script>
@endsection

@section('content')
    <section class="single padding50 minh">
        <div class="container">         
            <div>   
                <div class="main-title mb20">
                    <span>{{$title}}</span>
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
            </div>              
        </div>
    </section>

@endsection