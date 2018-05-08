@extends('layouts.main')

@section('title', $title )

@section('content')
    <script src='https://www.google.com/recaptcha/api.js?hl=az'></script>
    <section class="single padding50">
        <div class="container">         
            <div class="contact">   
                <div class="main-title mb20">
                    <span>{{$title}}</span>
                </div>
                <div class="clear"></div>           
                <div class="row">   
                    @include('flash::message')
                    <div class="col-sm-12 col-md-6">
                        {!! $content !!}
                    <div class="icons">
                        <a href="{{ $settings['facebook'] }}" class="fa sosial-bg fa-facebook"></a>
                        <a href="{{ $settings['youtube'] }}" class="fa sosial-bg fa-youtube"></a>
                        <a href="https://api.whatsapp.com/send?phone={{ $settings['whatsapp'] }}&text={{$title}}" class="fa sosial-bg fa-whatsapp"></a>
                    </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <form action="" class="auto-contact" method="post">     
                            {{csrf_field()}}         
                            <div class="col-xs-12">
                                <input type="text" name="contact[name]" class="form-control" id="" required="required" placeholder="Adnız">
                            </div>  
                            <div class="col-xs-12">
                                <input type="email" name="contact[email]" class="form-control" id="" required="required" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,18}$" placeholder="E-mail">
                            </div>  
                            <div class="col-xs-12">
                                <input type="text" name="contact[phone]" class="form-control" id="" required="required"  placeholder="Telefon">
                            </div>  
                            <div class="col-xs-12">
                                <input type="text" name="contact[company]" class="form-control" id="" required="required"  placeholder="Təmsil etdiyiniz şirkət">
                            </div>
                            <div class="col-xs-12">
                                <textarea name="contact[text]" class="form-control" rows="6" required="required" placeholder="Məktubun mətni"></textarea>
                            </div>
                            <div class="col-xs-12">
                                <!--<label>
                                    <input type="checkbox" value="">I'm not a robot
                                </label>
                                <img src="{{asset('img/captcha.png')}}" alt="">-->
                                <div class="g-recaptcha" data-sitekey="6LeCOEEUAAAAAAY0O08YDzcUtZkDZE7f7mMN6R_3"></div>
                            </div>
                            <div class="col-xs-12">
                                <div class="text-center mt30"><button type="submit" class="btn btn-lg">GÖNDƏR</button></div>
                            </div>                                          
                        </form>  
                    </div>
                </div>                  
            </div>              
        </div>
    </section>

@endsection