$(document).ready(function() {
    if($('a[data-toggle="collapse"]').length){
        $('a[data-toggle="collapse"]').trigger('click');
        _class = 'fa fa-action fa-';
        $('.fa-action').click(function(){
            $(this).prev().trigger('click'); 
            _has_class = $(this).hasClass('fa-minus');
            $('.fa-action').attr('class', _class+'plus');
            $(this).attr('class', _class+(_has_class?'plus':'minus'));
        });
    }
	// Header Scroll
	$(window).on('scroll', function() {
		var scroll = $(window).scrollTop();

		if (scroll >= 300) {
			$('#menu').addClass('fixed');
		} else {
			$('#menu').removeClass('fixed');
		}
	});

	$_loadmore=0;

	$('.load-more').click(function(e){
		e.preventDefault();
		
		_this = $(this);

        let _has_class = _this.hasClass('lent');
		let _data = {start:++$_loadmore, _token:$('[name="csrf-token"]').attr('content')};
		let _slug = $('[name="slug"]').val();
		if(_slug) _data['slug'] = _slug;
		
		if(_has_class) _data['lent'] = _this.attr('accesskey');
		
		_this.addClass('spin');
		
		$.post('/loadmore', _data , function(html){
			if(html){
				$('.load-to')[_has_class?'before':'append'](html);
				$('html,body').animate({scrollTop:$(window).scrollTop()+700}, 800);
			}else{
				$('.load-more').remove();
			}
			
			_this.removeClass('spin');
		});
	});
	
	$('.btn.questions').click(function(e){
	    e.preventDefault();
	    _s = $(this).parent().prev();
	    $.post('/addquestion', {_token:$('[name="csrf-token"]').attr('content'),question:_s.val().trim()}, function(response){
	        alert(response);
	        _s.val('');
	    });
	});

	$('.auto-contact').submit(function(e){

        if($(this).attr('accesskey') != 'success'){
            e.preventDefault();

            _elems = $('.auto-contact [name]');

            for(i=0;i< _elems.length ;i++){

                _name = $(_elems[i]).attr('name').trim();

                if(_name !== '' && ~_name.search('contact') ){

                    _name = _name.match(/\[(.*?)\]/)[1];

                    _value = $(_elems[i]).attr('placeholder');


                    $('.auto-contact').append('<input type="hidden" name="fields['+_name+']" value="'+_value+'" />');
                }

            }

            $(this).attr('accesskey','success');
            $(this).trigger('submit');
        }
    });
});
