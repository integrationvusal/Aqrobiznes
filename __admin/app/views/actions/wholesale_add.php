<?php

use jewish\backend\CMS;
use jewish\backend\helpers\utils;
use jewish\backend\helpers\view;

if (!defined("_VALID_PHP")) {die('Direct access to this location is not allowed.');}


// load CK Editor
view::appendJS(SITE_DIR.CMS_DIR.JS_DIR.'ckeditor/ckeditor.js');
?>
<style>
  .custom-combobox {
    position: relative;
    display: block;
  }
  .ui-button{
      background:#fff;
  }
  .custom-combobox-toggle {
    position: absolute;
    top: 0;
    bottom: 0;
    margin-left: -1px;
    padding: 0;
  }
  .custom-combobox-input {
    margin: 0;
    padding: 5px 10px;
    width: 97.5%;
    background: #fff;
  }
</style>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(function(){
    $.widget( "custom.combobox", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            classes: {
              "ui-tooltip": "ui-state-highlight"
            }
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -1 )
          .attr( "title", "Bütün Məhsullar" )
          .tooltip()
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox-toggle ui-corner-right" )
          .on( "mousedown", function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .on( "click", function() {
            input.trigger( "focus" );
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title", value + " Nəticə yoxdur " )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.autocomplete( "instance" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
 
    $( "#combobox" ).combobox();
});
</script>


<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		<?=CMS::t('menu_item_wholesale_add');?>
		<!-- <small>Subtitile</small> -->
	</h1>

	<!-- <ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Dashboard</li>
	</ol> -->
</section>

<!-- Content Header (Page header) -->
<section class="contextual-navigation">
	<nav>
		<a href="<?=utils::safeEcho($link_back, 1);?>" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> <?=CMS::t('back');?></a>
	</nav>
</section>


<!-- Main content -->
<section class="content">
	<?php
		if (!empty($op)) {
			if ($op['success']) {
				print view::notice($op['message'], 'success');
			} else {
				print view::notice(empty($op['errors'])? $op['message']: $op['errors']);
			}
		}
	?>

	<!-- Info boxes -->

	<div class="box">
		<!-- <div class="box-header with-border">
			<h3 class="box-title"><?=CMS::t('menu_item_wholesale_add');?></h3>
		</div> -->
		<!-- /.box-header -->

		<form action="" method="post" class="form-std" role="form" enctype="multipart/form-data">
			<input type="hidden" name="CSRF_token" value="<?=$CSRF_token;?>" />

			<div class="box-body">
				<div class="row">
					<div class="col-md-12">

						<div class="form-group">
							<label><?=CMS::t('article_publish_date_placeholder');?> *</label>
							<input type="text" name="date" id="datepicker" class="form-control" autocomplete="off" />
						</div>
						
						<div class="form-group">
							<label><?=CMS::t('wholesale_measure');?> *</label>
							<select name="measure" class="form-control">
							       <?foreach($measure as $m):?>
							            <option value="<?=$m['id']?>"><?=$m['name']?></option>
							       <?endforeach?>
							</select>
						</div>
						
						<div class="form-group">
							<label><?=CMS::t('wholesale_product');?> *</label>
							<select name="product" id="combobox" class="form-control">
							       <?foreach($product as $p):?>
							            <option value="<?=$p['id']?>"><?=$p['name']?></option>
							       <?endforeach?>
							</select>
						</div>
						
						<div class="form-group">
							<label><?=CMS::t('wholesale_pricetable');?> *</label>
							<div class="tmp">
							    <div class="row group-price">
							        <div class="col-xs-12">
    				                    <div class="input-group">
                                            <div class="input-group-btn">
                                                <input name="pricetable[types][]" type="text" class="form-control" placeholder="<?=CMS::t('wholesale_product_type')?>">
                                            </div>
                                            
                                            <div class="input-group-btn">
                                                <select name="pricetable[markets][]" class="form-control">
                                                    <option value="0"><?=CMS::t('wholesale_market')?></option>
                                                    <?foreach($markets as $ma):?>
                                                        <option value="<?=$ma['id']?>"><?=$ma['name']?></option>
                                                    <?endforeach?>
                                                </select>
                                            </div>
                                            
                                            <div class="input-group-btn">
                                                <input name="pricetable[prices][]" type="text" class="form-control" placeholder="<?=CMS::t('wholesale_price')?>">
                                            </div>
                                            
                                             <div class="input-group-btn">
                                                <button type="button" class="btn btn-success add-pricetable"><i class="fa  fa-plus"></i></button>
                                            
                                                <button type="button" class="btn btn-danger del-pricetable"><i class="fa  fa-times"></i></button>
                                            </div>
                                            
                                        </div>
    				                </div>
							    </div>
				    
							</div>
							<div class="row group-price">
							    <div class="col-xs-12">
							        <div class="input-group">
							    
                                        <div class="input-group-btn">
                                            <input name="pricetable[types][]" type="text" class="form-control" placeholder="<?=CMS::t('wholesale_product_type')?>">
                                        </div>
                                        
                                        <div class="input-group-btn">
                                            <select name="pricetable[markets][]" class="form-control">
                                                <option value="0"><?=CMS::t('wholesale_market')?></option>
                                                <?foreach($markets as $ma):?>
                                                    <option value="<?=$ma['id']?>"><?=$ma['name']?></option>
                                                <?endforeach?>
                                            </select>
                                        </div>
                                        
                                        <div class="input-group-btn">
                                            <input name="pricetable[prices][]" type="text" class="form-control" placeholder="<?=CMS::t('wholesale_price')?>">
                                        </div>
                                        
                                         <div class="input-group-btn">
                                                <button type="button" class="btn btn-success add-pricetable"><i class="fa  fa-plus"></i></button>
                                            
                                                <button type="button" class="btn btn-danger del-pricetable"><i class="fa  fa-times"></i></button>
                                            </div>
                                        
                                    </div>
							    </div>
							</div>
					
						</div>
						
						
						<div class="form-group">
							<input type="checkbox" name="is_published" value="1"<?=((isset($_POST['is_published']) && empty($_POST['is_published']))? '': ' checked="checked"');?> id="triggerwholesaleStatus" /><label for="triggerwholesaleStatus" style="display: inline; font-weight: normal;"> <?=CMS::t('publish');?></label>
						</div>
					</div>
				</div>
			</div>
			<!-- /.box-body -->

			<div class="box-footer">
				<button type="submit" name="add" value="1" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?=CMS::t('add');?></button>
				<button type="reset" name="reset" value="1" class="btn btn-default"><i class="fa fa-refresh" aria-hidden="true"></i> <?=CMS::t('reset');?></button>
			</div>
		</form>
	</div>
	<!-- /.box -->

	<!-- /.info boxes -->
</section>
<!-- /.content -->