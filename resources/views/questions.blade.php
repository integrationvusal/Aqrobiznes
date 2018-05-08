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
							<th>Sual</th>
							<th>Cavab</th>
						</tr>
						@foreach($questions as $question)
							<tr>
								<td>{!!$question['question']!!}</td>
								<td>{!!$question['answer']!!}</td>
							</tr>	
						@endforeach
					</table>
                </div>
            </div>              
        </div>
    </section>

@endsection