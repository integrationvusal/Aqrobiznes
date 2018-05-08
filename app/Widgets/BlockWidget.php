<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

use Illuminate\Http\Request;

class BlockWidget extends AbstractWidget
{

    protected $config = [];

    public function run(Request $request)
    {
        $html = '<ul class="nav nav-tabs" role="tablist">';
        
        foreach(trans('custom.blocks') as $route=>$block){
            ${0} = explode('_', $route);
            ${1} = explode('_', $request->route()->getName());
           $html.='<li role="presentation" class="'.(${0}[0] == ${1}[0]?'active':null).'">
                        <a href="'.route($route).'" aria-controls="'.$route.'">
                            '.$block.'
                        </a>
                    </li>';
        }

        return $html.'</ul>';
    }


}
