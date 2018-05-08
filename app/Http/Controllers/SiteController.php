<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\News;
use App\Menu;
use App\Gallery;
use App\Wholesale;
use App\Agrocalendar;
use App\Questions;
use App\Photoday;
use App\Videos;

use PHPMailer\PHPMailer\PHPMailer;

use Intervention\Image\ImageManagerStatic as Image;

class SiteController extends Controller
{
	public function home(){

		return view('home',[
			'title'=>'Ana səhifə',
			'wholesales'=>Wholesale::last(),
			'agrocalendar'=>Agrocalendar::all(),
			'questions'=>Questions::all(),
			'photoday'=>Photoday::get(['img', 'title']),
			'video'=>Videos::get(['link', 'title']),
			'news'=>News::all('news', 4),
			'dayphoto'=>News::all('dayphoto'),
			'interview' => News::get('interview', null, true),
			'clauses' => News::get('clauses'),
			'healthy' => News::get('news,clauses,interview', null, null, Article::getContent('saghlam-yasha')[0]['id']),
			'products' => json_decode(file_get_contents('http://aqromarket.aqrobiznes.az/pages/elanjson?hash='.hash_hmac('ripemd160', strtotime(date('Y-d-m H')),'y$2!Ac3$B68$'))),
		]);
	}
	
	public static function resize($url, $width=null, $height=null){

        if(!( $width && $height)) $width = 100;
        
		$img = Image::make(base64_decode($url))->resize($width, $height, function($c){
			$c->upsize();
		});

 		return $img->response('jpg');
	}


	public function clauses($slug=false){
		if(!$slug) $slug = News::get('clauses', 'd.m.Y, H:i')['sef'];

		$data = News::getContent($slug);

		if(!$data)	abort(404);

		return view('clauses', [
			'title'=>$data[0]['text'],
			'time'=>date('d.m.Y, H:i', strtotime($data[0]['add_datetime']) ),
			'content'=>$data[1]['text'],
			'img'=>$data[0]['img'],
			//'news'=>News::all('news', null, null, 'd.m.Y, H:i'),
			'clauses' => News::all('clauses', null, null, 'd.m.Y, H:i'),
			//'interviews' => News::all('interview', null, null, 'd.m.Y, H:i'),
			//'lastInterview'=>News::get('interview', 'd.m.Y, H:i')
		]);
	}

	public function interview($slug=false){
		if(!$slug) $slug = News::get('interview', 'd.m.Y, H:i')['sef'];

		$data = News::getContent($slug);

		if(!$data)	abort(404);

		return view('interview', [
			'title'=>$data[0]['text'],
			'time'=>date('d.m.Y, H:i', strtotime($data[0]['add_datetime']) ),
			'content'=>$data[1]['text'],
			'img'=>$data[0]['img'],
			//'news'=>News::all('news', null, null, 'd.m.Y, H:i'),
			//'clauses' => News::all('clauses', null, null, 'd.m.Y, H:i'),
			'interviews' => News::all('interview', null, null, 'd.m.Y, H:i'),
			//'lastClauses'=>News::get('clauses', 'd.m.Y, H:i')
		]);
	}

	public function category($slug){
		Article::setCounter($slug);
		$data = Article::getContent($slug);

		$menu = Menu::getContent($slug);

		if(!$data)	abort(404);

		return view('category', [
			'title'=>$data[0]['text'],
			'menu' => $menu['text'],
			'slug' => $slug,
			'time'=>date('d.m.Y, H:i', strtotime($data[0]['add_datetime']) ),
			'content'=>$data[1]['text'],
			'counter'=>$data[0]['counter'],
			'news' => News::all('news,clauses,interview', 6, null, 'd.m.Y, H:i', $data[0]['id']),
		]);
	}

	public function news_read($slug){
	    News::setCounter($slug);
		$data = News::getContent($slug);

		$menu = Menu::getByID($data[0]['category_id']);

		if(!$data)	abort(404);


		return view('news_read', [
			'title'=>$data[0]['text'],
			'img'=>$data[0]['img'],
			'lent'=>$data[0]['category_id'],
			'menu'=>$menu['type'] == 'category'?$menu['text']:null,
			'time'=>date('d.m.Y, H:i', strtotime($data[0]['add_datetime']) ),
			'content'=>$data[1]['text'],
			'counter'=>$data[0]['counter'],
			'news' => News::all('news,clauses,interview', 6, null, 'd.m.Y, H:i', $data[0]['category_id']),
		]);
	}


	public function news(){

		return view('news', [
			'title'=>'XƏBƏRLƏR',
			'news'=>News::all('news', 6, null, 'd.m.Y, H:i'),
			/*'clauses' => News::all('clauses', null, null, 'd.m.Y, H:i'),
			'interviews' => News::all('interview', null, null, 'd.m.Y, H:i'),
			'lastClauses'=>News::get('clauses', 'd.m.Y, H:i'),
			'lastInterview'=>News::get('interview', 'd.m.Y, H:i')*/
		]);
	}


	public function loadmore(Request $request){
		if($request->ajax()){
            $_id = $request->input('slug');
            $_lent = $request->input('lent');
            $_start = (int)$request->input('start');
            if($_lent){
                $menu = Menu::getByID($_lent);
                return view('loadmore_lent', ['menu'=>$menu['type'] == 'category'?$menu['text']:null,'news'=> News::all('news,clauses,interview', 6, $_start, 'd.m.Y, H:i', $_lent)]);
            }elseif($_id){
                $_id = Article::getContent($_id)[0]['id'];
                return view('loadmore', ['news'=> News::all('news', 6, $_start, 'd.m.Y, H:i', $_id)]);
            }
            return view('loadmore', ['news'=> News::all('news', 6, $_start, 'd.m.Y, H:i')]);
		}
	}

	public function photodays(){

		return view('photodays', [
			'title'=>'GÜNÜN FOTOLARI',
			'dayphoto'=>News::all('dayphoto')
		]);
	}
	
	public function addquestion(Request $request){

		if($request->ajax() && $request->isMethod('post')){
		    Questions::add($request->input('question'));
		    print 'Sualınız Administrator tərəfindən yoxlanıldıqdan sonra saytda dərc olunacaq!';
		}
	}


	public function photodays_read($slug){
	    News::setCounter($slug);
		$data = News::getContent($slug);


		if(!$data)	abort(404);


		return view('category', [
			'title'=>$data[0]['text'],
			'time'=>date('d.m.Y, H:i', strtotime($data[0]['add_datetime']) ),
			'content'=>$data[1]['text'],
			'counter'=>$data[0]['counter'],
			'slug'=>$slug,
			'menu'=>$data[0]['text'],
			'news' => News::all('dayphoto', null, null, 'd.m.Y, H:i'),
		]);
	}


	public function videos(){

		return view('videos', [
			'title'=>'VİDEOTƏLİMLƏR',
			'videos'=>Videos::all()
		]);
	}

    public function wholesales(){

		return view('wholesales', [
			'title'=>'BAZAR QİYMƏTLƏRİ',
			'wholesales'=>Wholesale::all()
		]);
	}

    public function agrocalendar(){

		return view('agrocalendar', [
			'title'=>'AQROTƏQVİM',
			'agrocalendar'=>Agrocalendar::all()
		]);
	}
	
	public function questions(){

		return view('questions', [
			'title'=>'BİZDƏN SORUŞURLAR',
			'questions'=>Questions::all()
		]);
	}


	public function contact(Request $request, $slug){

        $data = Article::getContent($slug);

		if(!$data)	abort(404);


		if($request->isMethod('post')){

			$_p = $request->all();

            $recaptcha = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6LeCOEEUAAAAAE2J6TldskMYyLtaNRMI-SgTtEu6&response='.$_p['g-recaptcha-response'].'&remoteip='.$_SERVER['REMOTE_ADDR']));

            if($recaptcha->success == 1){
                $_html = '<table cellspacing="0" cellpadding="0" border="1" width="100%">';

    			foreach ($_p['contact'] as $k=>$_c) {
    				$_html.='
    					<tr>
    						<td>'.$_p['fields'][$k].'</td>
    						<td>'.$_c.'</td>
    					</tr>
    				';
    			}

    			$_html.='</table>';


                $mail = new PHPMailer;
				$mail->isSMTP();
				$mail->Host = 'smtp.mail.gov.az';
				$mail->Port = 587;
				$mail->SMTPSecure = 'tls';    
				$mail->SMTPAuth = true;
				$mail->CharSet = 'UTF-8';
				$mail->IsHTML(true);
				$mail->Username = 'mail@tedaruk.gov.az';
				$mail->Password = 'Baku@2017';
				$mail->setFrom('mail@tedaruk.gov.az','Aqrobiznes');

				$mail->addAddress($this->_settings['email'], 'Mail Aqrobiznes');
				$mail->Subject = 'Aqrobiznes - Əlaqə';

				$mail->msgHTML($_html);
				
				if (!$mail->send()) 
					flash('Məlumatlar uğurla göndərildi!')->success();
				 else 
					flash('Məlumatları göndərmək mümkün olmadı!')->error(); 
            }
            else
                flash('Robot olmadığınızı təsdiq eliyin!')->error();

            return redirect()->refresh();
		}

		return view('contact', [ 'title'=>$data[0]['text'], 'content'=>$data[1]['text']]);
	}


	public function gallery($slug){
		$data = Menu::getContent($slug);

		if(!$data)	abort(404);

		return view('gallery', ['title'=>$data['text'], 'galleries'=>Gallery::all() ]);
	}

	public function error(){
		return view('error');
	}
}
