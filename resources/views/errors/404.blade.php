@extends('layouts.main')

@section('title', 'Səhifə mövcud deyil')

@section('content')


    <section class="single padding50">
        <div class="container">
            <div class="row">       

                <div class="col-md-12">
                    <div class="main-title">
                        <span>Səhifə mövcud deyil</span>
                    </div>
                    <div class="clear"></div>                   
                    <img class="center-block" src="{{asset('img/404.png')}}"/>
                </div>

            </div>
        </div>
    </section>

@endsection