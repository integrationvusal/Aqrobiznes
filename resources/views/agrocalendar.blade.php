@extends('layouts.main')

@section('title', $title )

@section('content')
 
     <section class="single padding50 minh">
        <div class="container">   
            <div class="main-title mb20">
                <span>{{$title}}</span>
            </div>
            <div class="clear"></div>           
            <div class="row">   
                <div class="col-sm-12">
                    <table class="table table-striped table-bordered">
						<tr>
							<th>Tarix</th>
							<th>Görülən işlər</th>
						</tr>
						@foreach($agrocalendar as $agro)
							<tr>
								<td width="32%">{{Helper::df($agro['date_from'])}} - {{Helper::df($agro['date_to'])}}</td>
								<td>
									{{$agro['title']}}
								</td>
							</tr>	
						@endforeach
					</table>
                </div>
            </div>              
        </div>
    </section>

@endsection