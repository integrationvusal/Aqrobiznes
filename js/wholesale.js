$(function(){
    
    truncate = function (elm){
        return elm.find('option').remove().prevObject;
    }
    
    addOptions = function(elem, data, txt = 'Növü seçin', market=false){
        _html='<option accesskey="0.00" value="">'+txt+'</option>';
        for(var x in data){
            _html+='<option accesskey="'+(market?data[x]:'')+'" value="'+x+'">'+x+'</option>';
        }
        elem.append(_html);
    }
    
    clearPrice = function (parent){
        parent.find('.whole-price').text('0.00');
    }
    
    
    $('.form-control.product').change(function(){
        _currentParent = $(this).parents('tr.wholesale');
        truncate(_currentParent.find('.form-control.types'));
        truncate(_currentParent.find('.form-control.markets'));
        truncate(_currentParent.find('.form-control.measures'));
        clearPrice(_currentParent);
        _product_val = $(this).val();
        
        if(_product_val){
           _date = _currentParent.find('.whole-date').text(); 
           
           _product_data = _wholes_data[_date][_product_val];
           
           _currentParent.find('.form-control.measures').append('<option>'+_product_data['measure']+'</option>');
           
           addOptions(_currentParent.find('.form-control.types'), _product_data['types']);
        }
        
    });
    
    
    $('body').on('change', '.form-control.types', function(){
        _currentParent = $(this).parents('tr.wholesale');
        truncate(_currentParent.find('.form-control.markets'));
        clearPrice(_currentParent);
        _type_val = $(this).val();
        
        if(_type_val){
            _date = _currentParent.find('.whole-date').text(); 
            _product_val = _currentParent.find('.form-control.product').val();
            _product_data =_wholes_data[_date][_product_val];
            addOptions(_currentParent.find('.form-control.markets'), _product_data['types'][_type_val], 'Bazarı seçin', true);
        }
    });
    
    $('body').on('change', '.form-control.markets', function(){
        $(this).parents('tr.wholesale').find('.whole-price').text(parseFloat($(':selected', this).attr('accesskey')).toFixed(2));
    });
});