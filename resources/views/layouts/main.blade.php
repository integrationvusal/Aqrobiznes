<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:title" content="{{$settings['site_name']}} - @yield('title')">
    <meta property="og:description" content="{{$settings['site_desc']}}">
    <meta property="og:image" content="{{$page_img}}">
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="200">
    <meta property="og:type" content="article" />
    <meta property="fb:app_id" content="396370347439543" />
    <meta property="og:url" content="{{$page_url}}">
    <meta property="og:site_name" content="{{$settings['site_name']}}">
     
    <meta name="twitter:card" content="summary_large_image">
    <meta name="theme-color" content="#ff3300" />
    <meta name="twitter:image:alt" content="{{$settings['site_name']}} - @yield('title')">

    <title>{{$settings['site_name']}} - @yield('title')</title>
    
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">
    
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/owl.carousel.css')}}" rel="stylesheet" />
    <link href="{{asset('css/owl.theme.default.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/hover.css')}}" rel="stylesheet" />
    <link href="{{asset('css/js-image-slider.css')}}" rel="stylesheet" />
    <link href="{{asset('css/style.css')}}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/jssocials.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/jssocials-theme-minima.css')}}" />
    <script type='text/javascript' src="{{asset('js/less.js')}}"></script>

</head>

<body>
  <div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = 'https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v3.0&appId=396370347439543&autoLogAppEvents=1';
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
    
    <header>		
		<div id="sliderFrame">
			<div id="slider">
			    @foreach($slider as $s)
				    <img src="{{asset('upload/slider/'.$s['img'])}}" alt="" />
				@endforeach
			</div>
			<div class="clear"></div>
		</div>
		<nav class="navbar navbar-default">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>				
					
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					@widget('MenuWidget', ['submenu'=>false])
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
		<!-- <h1 class="text-center">AQROBIZNES</h1>		 -->
	</header>

    @yield('content')


    <footer class="padding50">
        <div class="container">
            <div class="row slideanim">
                <div class="col-xs-12">
                    
                    @widget('MenuWidget', ['class'=>'list-inline', 'submenu'=>false, 'brand'=>false])

                    <p>{!! $settings['footer_text'] !!}</p>

                    <div class="live_count">
                        <!--LiveInternet counter-->
                        <script type="text/javascript">
                            document.write("<a href='//www.liveinternet.ru/click' "+
                            "target=_blank><img src='//counter.yadro.ru/hit?t28.6;r"+
                            escape(document.referrer)+((typeof(screen)=="undefined")?"":
                            ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
                            screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
                            ";h"+escape(document.title.substring(0,150))+";"+Math.random()+
                            "'"+"border='0' width='88' height='120'><\/a>")
                            </script>
                        <!--/LiveInternet-->
                    </div>

                </div>
            </div>
        </div>
    </footer>

    <script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/owl.carousel.js')}}"></script>
    <script src="{{asset('js/js-image-slider.js')}}"></script>
    <script src="{{asset('js/jssocials.min.js')}}"></script>
    <script src="{{asset('js/aqrobiznes.js')}}"></script>
    @yield('script')
    <script>
		$(document).ready(function(){
		   $(window).scroll(function() {
			  $(".slideanim").each(function(){
			    var pos = $(this).offset().top;

			    var winTop = $(window).scrollTop();
			    if (pos < winTop + $(window).height()) {
			      $(this).addClass("slide");
			    }
			  });
			});
		});		
	</script>
	<script>
		$('#alqi-satqi .owl-carousel').owlCarousel({
		    loop:true,
		    margin:20,
		    nav:true,
		    autoplay:true,
		    responsive:{
		        0:{
		            items:1
		        },
		        400:{
		            items:2
		        },
		        600:{
		            items:3
		        },
		        1000:{
		            items:5
		        }
		    }
		})
	</script>

	<script>
		$('#partners .owl-carousel').owlCarousel({
		    loop:true,
		    margin:20,
		    nav:true,
		    autoplay:true,
		    responsive:{
		        0:{
		            items:1
		        },
		        400:{
		            items:2
		        },
		        600:{
		            items:3
		        },
		        1000:{
		            items:5
		        }
		    }
		})
	</script>
	<!--Start of Tawk.to Script-->
	<script type="text/javascript">
	var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
	(function(){
	var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
	s1.async=true;
	s1.src='https://embed.tawk.to/5aa91f194b401e45400db9b0/default';
	s1.charset='UTF-8';
	s1.setAttribute('crossorigin','*');
	s0.parentNode.insertBefore(s1,s0);
	})();
	</script>
	<!--End of Tawk.to Script-->
</body>

</html>