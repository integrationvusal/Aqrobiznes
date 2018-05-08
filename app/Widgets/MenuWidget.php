<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

use App\Menu;

class MenuWidget extends AbstractWidget
{

    protected $config = ['class'=>'nav navbar-nav', 'submenu'=>true, 'brand'=>true];

    private $href; 

    public function run()
    {
        $this->href = isset($_SERVER['REDIRECT_URL'])?$_SERVER['APP_URL'].$_SERVER['REDIRECT_URL']:'/';
        return $this->tree();
    }

    private function tree($datas = [], $i=0){

    	if(empty($datas)) $datas = Menu::getMenu();

    	$html = $i?'<ul class="dropdown-menu">':'<ul class="'.$this->config['class'].'">'.($this->config['brand']?'<a class="navbar-brand" href="/"><img src="/img/aqro2.png" alt="" class="logo"></a>':null);
        //$_avg = floor(count($datas)/2);

    	foreach ($datas as $k=>$data) {
        
            $target = '';
            
            if($data['type'] == 'url'){
                $target='target="_blank"';
                $_url = $data['url'];
            }else{
                $countParams = count(\Route::getRoutes()->getByName($data['type'])->parameterNames());
                
    		    $_url = urldecode($data['sef'] == 'home'?'/':( $countParams?route($data['type'],['sef'=>$data['sef']]):route($data['type']) ));
            }
            
            $_active = $_url == $this->href?'active':null;

    		if(isset($data['children']) && $this->config['submenu']){
    			$html.='<li class="dropdown">
                            <a href="'.$_url.'" class="dropdown-toggle '.$_active.'" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$data['name'].'<span class="caret"></span></a>
                            '.$this->tree($data['children'], ++$i).'
                        </li>';
    		}
    		else{
    			$html.='<li><a class="'.$_active.'" '.$target.' href="'.$_url.'">'.$data['name'].'</a></li>';
            }
    	}
    	return $html.'</ul>';
    }

}
