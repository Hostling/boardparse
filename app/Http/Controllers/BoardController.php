<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Board;
use App\Sites;
//use App\Http\Controllers\Controller;

class BoardController extends Controller
{
    public function index()
    {
    	$posts = DB::table('dgimc_posts')->select()->where('post_type', 'product')->orderBy('post_date','desc')->paginate(30);
    	return view('index',['posts' => $posts]);
    }

    public function kolvo(Request $request)
    {
    	$posts = DB::table('dgimc_posts')->select()->where('post_type', 'product')->orderBy('post_date','desc')->paginate($request->kolvo);
    	return view('index',['posts' => $posts]);
    }

    public function createOb(Request $request)
    {
        switch($request->input("board")){
            case 'sindom':
                $this->sindom($request);
                return redirect()->route('created');
            break;
            case 'leboard':
                $this->leboard($request);
                return redirect()->route('created');
            break;
            case 'divobazar':
                $this->divobazar($request);
                return redirect()->route('created');
            break;
            case 'bonzon':
                $this->bonzon($request);
                return redirect()->route('created');
            break;
            case 'rydo':
                $this->rydo($request);
                return redirect()->route('created');
            break;
            case '1000goods':
                $this->goods($request);
                return redirect()->route('created');
            break;
            case 'kuraga':
                $this->kuraga($request);
                return redirect()->route('created');
            break;
            case 'gorodets':
                $this->gorodets($request);
                return redirect()->route('created');
            break;
            case 'sar164':
                $this->sar164($request);
                return redirect()->route('created');
            break;
            case 'itebe':
                $this->itebe($request);
                return redirect()->route('created');
            break;
            case 'zpost':
                $this->zpost($request);
                return redirect()->route('created');
            break;
            case 'apipost':
                $this->apipost($request);
                return redirect()->route('created');
            break;
            default:
                echo 'Не передано название доски';
        }

    }
    public function created()
    {

        $all = DB::table('parser')->select()->orderBy('date','desc')->limit(10)->get();
        return view('create',['ob' => $all]);   
    }
    public function crkolvo(Request $request)
    {

        $all = DB::table('parser')->select()->orderBy('date','desc')->limit($request->kolvo)->get();
        return view('create',['ob' => $all]);   
    }

    public function sandbox(Request $request)
    {
        //----==========Сценарий создания объявления==========----
                

        //1. На вход получаем номер объявления и доску
        //2. Дергаем из базы цену, заголовок, тело объявления
            
            // $price = Board::getPrice($request->input("num"));
            // $descr = DB::table('dgimc_posts')->where('ID', $request->input("num"))->value('post_excerpt');
            // $descr = Board::getDescr($descr);
            // $title = DB::table('dgimc_posts')->where('ID', $request->input("num"))->value('post_title');
            // $title = Board::getTitle($title);
        //8. Качаем картинку на наш сервер. На выходе ловим имя файла
            // $curl = curl_init();
            // $site = new Sites;
            // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,false);
            // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            // $ch = curl_init();
            // $imglink = Board::getImage($request->input("num"));
            // $fname = $site->dlImg($ch, $imglink);
            // curl_close($ch);
            // $data = new \CurlFile($fname, mime_content_type($fname), basename($fname));

        //4. Инициируем curl, авторизовываемся и получаем cookie
            // $auth = $site->SiteAuth($curl, config('sites.'.$request->input("board").'.post'), config('sites.'.$request->input("board").'.loginurl'), config('sites'.$request->input("board").'.cookiename'));
        //5. Создаем объявление через $site->MakeOb. На выходе ловим тело страницы с номером объявления 
            // $postcr = config('sites.'.$request->input("board").'.postcr');
            // $postcr[config('sites.'.$request->input("board").'.postprice')] = $price;
            // $postcr[config('sites.'.$request->input("board").'.postdescr')] = $descr;
            // $postcr[config('sites.'.$request->input("board").'.posttitle')] = $title;
            // $postcr['foto[]'] = $data;
            // $postimg['foto[]'] = $data;

            // $k = $site->GetPage($curl, config('sites.'.$request->input("board").'.posturl'), config('sites'.$request->input("board").'.cookiename'));
            // $kp = $site->findId(config('sites.'.$request->input("board").'.editurlbegin'), config('sites.'.$request->input("board").'.editurlend'), $k);
            // $postcr['dop_kp'] = $kp;
            // $ob = $site->uploadImg($curl, config('sites.'.$request->input("board").'.posturl'), $postcr, config('sites'.$request->input("board").'.cookiename'));
            // $obnum = $site->findId(config('sites.'.$request->input("board").'.linkbegin'), config('sites.'.$request->input("board").'.linkend'), $ob);

        //     $act = 'http://rydo.ru';
        //     $act .= $activate;
  
        //     $site->SaveToDB($request->input("num"),$request->input("board"),$title, $act);
        //6. Получаем номер объявления
        //     // echo $oblink;
        //     $act = str_replace('/activate/', '', $act);
        //     $site->SaveToDB($request->input("num"),$request->input("board"),$title, $act);
        //     $obnum = $site->findId(config('sites.'.$request->input("board").'.editurlbegin'),config('sites.'.$request->input("board").'.editurlend'), $oblink);
        //7. Формируем ссылку для редактирования
        //     $editurl = config('sites.'.$request->input("board").'.editurl1');
        //     $editurl .= $obnum;
        //     $editurl .= config('sites.'.$request->input("board").'.editurl2');
        
        //9.1. Формируем ссылку для загрузки фото
        //         //Для sindom грузим страницу редактирования фото и берем 2 параметра
        //         $uploadParams = $site->GetPage($curl, $editurl, config('sites'.$request->input("board").'.cookiename'));
        //         $param1 = $site->findId(config('sites.'.$request->input("board").'.param1begin'),config('sites.'.$request->input("board").'.param1end'), $uploadParams);
        //         $param2 = $site->findId(config('sites.'.$request->input("board").'.param2begin'),config('sites.'.$request->input("board").'.param2end'), $uploadParams);
   
        //     $urlupload = config('sites.'.$request->input("board").'.urlupload1');
        //         if($request->input("board") == 'sindom')
        //         {
        //             $urlupload .= $obnum;
        //         }
        //     $urlupload .= config('sites.'.$request->input("board").'.urlupload2');
        //     $urlupload .= $param1;
        //     $urlupload .= config('sites.'.$request->input("board").'.urlupload3');
        //     $urlupload .= $param2;

        //     $data = new \CurlFile($fname, mime_content_type($fname), basename($fname));
        //     $postdata[] = '';
        //     $postdata = config('sites.'.$request->input("board").'.postdata');      
        //     $postdata[config('sites.'.$request->input("board").'.postdatafieldname')] = $data;
        //         //leboard
        //         $postdata['_token'] = $token;
        //9.2. Грузим картинку на доску объявлений. На выходе ловим номер файла на сервере.
            // $imgid = $site->uploadImg($curl, $urlupload, $postdata, config('sites'.$request->input("board").'.cookiename'));
            // $imgid = $site->findId(config('sites.'.$request->input("board").'.postdataidbegin'),config('sites.'.$request->input("board").'.postdataidend'), $imgid);
            // $imgid = str_replace('\\', '', $imgid);
        //10. Собираем post запрос на привязку картинки
        //     $postudimg = config('sites.'.$request->input("board").'.postudimage');
        //     $postudimg .= config('sites.'.$request->input("board").'.postprice');
        //     $postudimg .= $price;
        //     $postudimg .= config('sites.'.$request->input("board").'.postdescr');
        //     $postudimg .= $descr;
        //     $postudimg .= config('sites.'.$request->input("board").'.posttitle');
        //     $postudimg .= $title;
        //     $postudimg .= config('sites.'.$request->input("board").'.postudimglink');
        //     $postudimg .= $imgid;
        //         //leboard
        //         $postudimg .= config('sites.'.$request->input("board").'.postudmainphoto');
        //         $postudimg .= $imgid;
        //         $postudimg .= "&_token=".$token; //Для leboard нужен токен
        //11. Привязываем картинку к объявлению
        //     $setimg = $site->SetUploadedImg($curl, $editurl, $postudimg, config('sites'.$request->input("board").'.cookiename'));
        //12. Закрываем соединение
            // curl_close($curl);

        //13. Пишем в лог
            // $site->SaveToDB($request->input("num"),$request->input("board"),$title, $obnum);
            
    }
    public function sindom(Request $request)
    {

        $price = Board::getPrice($request->input("num"));
        $descr = DB::table('dgimc_posts')->where('ID', $request->input("num"))->value('post_excerpt');
        $descr = Board::getDescr($descr);
        $title = DB::table('dgimc_posts')->where('ID', $request->input("num"))->value('post_title');
        $title = Board::getTitle($title);
        $postcr = config('sites.'.$request->input("board").'.postcr');
        $postcr .= config('sites.'.$request->input("board").'.postprice');
        $postcr .= $price;
        $postcr .= config('sites.'.$request->input("board").'.postdescr');
        $postcr .= $descr;
        $postcr .= config('sites.'.$request->input("board").'.posttitle');
        $postcr .= $title;
        $curl = curl_init();
        $site = new Sites;
        $post = config('sites.'.$request->input("board").'.post');
        $auth = $site->SiteAuth($curl, $post, config('sites.'.$request->input("board").'.loginurl'), config('sites'.$request->input("board").'.cookiename'));
        $oblink = $site->MakeOb($curl, $postcr, config('sites.'.$request->input("board").'.posturl'), config('sites'.$request->input("board").'.cookiename'));
        $obnum = $site->findId(config('sites.'.$request->input("board").'.editurlbegin'),config('sites.'.$request->input("board").'.editurlend'), $oblink);
        $editurl = config('sites.'.$request->input("board").'.editurl1');
        $editurl .= $obnum;
        $editurl .= config('sites.'.$request->input("board").'.editurl2');
            $ch = curl_init();
            $imglink = Board::getImage($request->input("num"));
            $fname = $site->dlImg($ch, $imglink);
            curl_close($ch);
        $uploadParams = $site->GetPage($curl, $editurl, config('sites'.$request->input("board").'.cookiename'));
        $param1 = $site->findId(config('sites.'.$request->input("board").'.param1begin'),config('sites.'.$request->input("board").'.param1end'), $uploadParams);
        $param2 = $site->findId(config('sites.'.$request->input("board").'.param2begin'),config('sites.'.$request->input("board").'.param2end'), $uploadParams);
        $urlupload = config('sites.'.$request->input("board").'.urlupload1');
        $urlupload .= $obnum;
        $urlupload .= config('sites.'.$request->input("board").'.urlupload2');
        $urlupload .= $param1;
        $urlupload .= config('sites.'.$request->input("board").'.urlupload3');
        $urlupload .= $param2;
        $data = new \CurlFile($fname, mime_content_type($fname), basename($fname));
        $postdata[] = '';
        $postdata = config('sites.'.$request->input("board").'.postdata');      
        $postdata[config('sites.'.$request->input("board").'.postdatafieldname')] = $data;
        $imgid = $site->uploadImg($curl, $urlupload, $postdata, config('sites'.$request->input("board").'.cookiename'));
        $imgid = $site->findId(config('sites.'.$request->input("board").'.postdataidbegin'),config('sites.'.$request->input("board").'.postdataidend'), $imgid);
        $postudimg = config('sites.'.$request->input("board").'.postudimage');
        $postudimg .= config('sites.'.$request->input("board").'.postprice');
        $postudimg .= $price;
        $postudimg .= config('sites.'.$request->input("board").'.postdescr');
        $postudimg .= $descr;
        $postudimg .= config('sites.'.$request->input("board").'.posttitle');
        $postudimg .= $title;
        $postudimg .= config('sites.'.$request->input("board").'.postudimglink');
        $postudimg .= $imgid;
        $setimg = $site->SetUploadedImg($curl, $editurl, $postudimg, config('sites'.$request->input("board").'.cookiename'));
        curl_close($curl);
        $site->SaveToDB($request->input("num"),$request->input("board"),$title, $editurl);
    }
    public function leboard(Request $request)
    {
        //Минимальный размер фотографии 400400 пикселей
        $price = Board::getPrice($request->input("num"));
        $descr = DB::table('dgimc_posts')->where('ID', $request->input("num"))->value('post_excerpt');
        $descr = Board::getDescr($descr);
        $title = DB::table('dgimc_posts')->where('ID', $request->input("num"))->value('post_title');
        $title = Board::getTitle($title);
        $postcr = config('sites.'.$request->input("board").'.postcr');
        $postcr .= config('sites.'.$request->input("board").'.postprice');
        $postcr .= $price;
        $postcr .= config('sites.'.$request->input("board").'.postdescr');
        $postcr .= $descr;
        $postcr .= config('sites.'.$request->input("board").'.posttitle');
        $postcr .= $title;
        $curl = curl_init();
        $site = new Sites;
        $gettoken = $site->GetPage($curl, config('sites.'.$request->input("board").'.loginurl'), config('sites'.$request->input("board").'.cookiename'));
        $token = $site->findId('<input type="hidden" name="_token" value="', '">', $gettoken);
        $post = "_token=".$token."&email=".config('sites.'.$request->input("board").'.board_login')."&password=".config('sites.'.$request->input("board").'.board_pass')."&remember=on";
        $postcr .= "&_token=".$token;
        $auth = $site->SiteAuth($curl, $post, config('sites.'.$request->input("board").'.loginurl'), config('sites'.$request->input("board").'.cookiename'));
        $oblink = $site->MakeOb($curl, $postcr, config('sites.'.$request->input("board").'.posturl'), config('sites'.$request->input("board").'.cookiename'));
        $obnum = $site->findId(config('sites.'.$request->input("board").'.editurlbegin'),config('sites.'.$request->input("board").'.editurlend'), $oblink);
        $editurl = config('sites.'.$request->input("board").'.editurl1');
        $editurl .= $obnum;
        $editurl .= config('sites.'.$request->input("board").'.editurl2');
            $ch = curl_init();
            $imglink = Board::getImage($request->input("num"));
            $fname = $site->dlImg($ch, $imglink);
            curl_close($ch);
        $uploadParams = $site->GetPage($curl, $editurl, config('sites'.$request->input("board").'.cookiename'));
        $param1 = $site->findId(config('sites.'.$request->input("board").'.param1begin'),config('sites.'.$request->input("board").'.param1end'), $uploadParams);
        $urlupload = config('sites.'.$request->input("board").'.urlupload1');
        $urlupload .= config('sites.'.$request->input("board").'.urlupload2');
        $urlupload .= $param1;
        $data = new \CurlFile($fname, mime_content_type($fname), basename($fname));
        $postdata[] = '';
        $postdata = config('sites.'.$request->input("board").'.postdata');      
        $postdata[config('sites.'.$request->input("board").'.postdatafieldname')] = $data;
        $postdata['_token'] = $token;
        $imgid = $site->uploadImg($curl, $urlupload, $postdata, config('sites'.$request->input("board").'.cookiename'));
        $imgid = $site->findId(config('sites.'.$request->input("board").'.postdataidbegin'),config('sites.'.$request->input("board").'.postdataidend'), $imgid);
        $imgid = str_replace('\\', '', $imgid);
        $postudimg = config('sites.'.$request->input("board").'.postudimage');
        $postudimg .= config('sites.'.$request->input("board").'.postprice');
        $postudimg .= $price;
        $postudimg .= config('sites.'.$request->input("board").'.postdescr');
        $postudimg .= $descr;
        $postudimg .= config('sites.'.$request->input("board").'.posttitle');
        $postudimg .= $title;
        $postudimg .= config('sites.'.$request->input("board").'.postudimglink');
        $postudimg .= $imgid;
        $postudimg .= config('sites.'.$request->input("board").'.postudmainphoto');
        $postudimg .= $imgid;
        $postudimg .= "&_token=".$token;
        $setimg = $site->SetUploadedImg($curl, $editurl, $postudimg, config('sites'.$request->input("board").'.cookiename'));
        curl_close($curl);
        $site->SaveToDB($request->input("num"),$request->input("board"),$title, $editurl);
    }
    public function divobazar(Request $request)
    {
        $price = Board::getPrice($request->input("num"));
        $descr = DB::table('dgimc_posts')->where('ID', $request->input("num"))->value('post_excerpt');
        $descr = Board::getDescr($descr);
        $title = DB::table('dgimc_posts')->where('ID', $request->input("num"))->value('post_title');
        $title = Board::getTitle($title);
        $curl = curl_init();
        $site = new Sites;
        $ch = curl_init();
        $imglink = Board::getImage($request->input("num"));
        $fname = $site->dlImg($ch, $imglink);
        curl_close($ch);
        $data = new \CurlFile($fname, mime_content_type($fname), basename($fname));
        $postcr[] = '';
        $postcr = config('sites.'.$request->input("board").'.postcr');
        $postcr[config('sites.'.$request->input("board").'.postprice')] = $price;
        $postcr[config('sites.'.$request->input("board").'.postdescr')] = $descr;
        $postcr[config('sites.'.$request->input("board").'.posttitle')] = $title;
        $postcr['foto'] = $data;
        $postdata = [
            'foto' => $data
        ];
        $post = config('sites.'.$request->input("board").'.post');
        $auth = $site->SiteAuth($curl, $post, config('sites.'.$request->input("board").'.loginurl'), config('sites'.$request->input("board").'.cookiename'));
        $imgid = $site->uploadImg($curl, config('sites.'.$request->input("board").'.urlupload1'), $postdata, config('sites'.$request->input("board").'.cookiename'));
        $oblink = $site->MakeOb($curl, $postcr, config('sites.'.$request->input("board").'.posturl'), config('sites'.$request->input("board").'.cookiename'));
        $editurl2 = $site->findId(config('sites.'.$request->input("board").'.editurlbegin'), config('sites.'.$request->input("board").'.editurlend'), $oblink);
        $editurl = config('sites.'.$request->input("board").'.editurl1');
        $editurl .= $editurl2;
        curl_close($curl);    
        $site->SaveToDB($request->input("num"),$request->input("board"),$title, $editurl);
    }
    public function bonzon(Request $request)
    {
        $price = Board::getPrice($request->input("num"));
        $descr = DB::table('dgimc_posts')->where('ID', $request->input("num"))->value('post_excerpt');
        $descr = Board::getDescr($descr);
        $title = DB::table('dgimc_posts')->where('ID', $request->input("num"))->value('post_title');
        $title = Board::getTitle($title);
        $curl = curl_init();
        $site = new Sites;
        $ch = curl_init();
        $imglink = Board::getImage($request->input("num"));
        $fname = $site->dlImg($ch, $imglink);
        curl_close($ch);
        $data = new \CurlFile($fname, mime_content_type($fname), basename($fname));
        $postcr[] = '';
        $postcr = config('sites.'.$request->input("board").'.postcr');
        $postcr[config('sites.'.$request->input("board").'.postprice')] = $price;
        $postcr[config('sites.'.$request->input("board").'.postdescr')] = $descr;
        $postcr[config('sites.'.$request->input("board").'.posttitle')] = $title;
        $postcr['foto'] = $data;
        $postdata = [
            'foto' => $data
        ];
        $post = config('sites.'.$request->input("board").'.post');
        $auth = $site->SiteAuth($curl, $post, config('sites.'.$request->input("board").'.loginurl'), config('sites'.$request->input("board").'.cookiename'));
        $imgid = $site->uploadImg($curl, config('sites.'.$request->input("board").'.urlupload1'), $postdata, config('sites'.$request->input("board").'.cookiename'));
        $oblink = $site->MakeOb($curl, $postcr, config('sites.'.$request->input("board").'.posturl'), config('sites'.$request->input("board").'.cookiename'));
        $editurl2 = $site->findId(config('sites.'.$request->input("board").'.editurlbegin'), config('sites.'.$request->input("board").'.editurlend'), $oblink);
        $editurl = config('sites.'.$request->input("board").'.editurl1');
        $editurl .= $editurl2;
        curl_close($curl);    
        $site->SaveToDB($request->input("num"),$request->input("board"),$title, $editurl);
    }
    public function rydo(Request $request)
    {
        $price = Board::getPrice($request->input("num"));
        $descr = DB::table('dgimc_posts')->where('ID', $request->input("num"))->value('post_excerpt');
        $descr = Board::getDescr($descr);
        $title = DB::table('dgimc_posts')->where('ID', $request->input("num"))->value('post_title');
        $title = Board::getTitle($title);
        $curl = curl_init();
        $site = new Sites;
        $ch = curl_init();
        $imglink = Board::getImage($request->input("num"));
        $fname = $site->dlImg($ch, $imglink);
        curl_close($ch);
        $data = new \CurlFile($fname, mime_content_type($fname), basename($fname));
        $gettoken = $site->GetPage($curl, config('sites.'.$request->input("board").'.loginurl'), config('sites'.$request->input("board").'.cookiename'));
        $token = $site->findId('name=\'csrfmiddlewaretoken\' value=\'', '\' />', $gettoken);
        $post = config('sites.'.$request->input("board").'.post');
        $post .= $token;
        $auth = $site->SiteAuth($curl, $post, config('sites.'.$request->input("board").'.loginurl'), config('sites'.$request->input("board").'.cookiename'));
        $gettoken = $site->GetPage($curl, config('sites.'.$request->input("board").'.posturl'), config('sites'.$request->input("board").'.cookiename'));
        $token = $site->findId('name=\'csrfmiddlewaretoken\' value=\'', '\' />', $gettoken);
        $post = config('sites.'.$request->input("board").'.post');
        $post .= $token;
        $postcr['csrfmiddlewaretoken'] = $token;
        $postcr = array_merge($postcr, config('sites.'.$request->input("board").'.postcr'));
        $postcr[config('sites.'.$request->input("board").'.postprice')] = $price;
        $postcr[config('sites.'.$request->input("board").'.postdescr')] = $descr;
        $postcr[config('sites.'.$request->input("board").'.posttitle')] = $title;
        $postcr['image[]'] = $data;
        $oblink = $site->uploadImg($curl, config('sites.'.$request->input("board").'.posturl'), $postcr, config('sites'.$request->input("board").'.cookiename'));
        $profile = $site->GetPage($curl, config('sites.'.$request->input("board").'.editurl'), config('sites'.$request->input("board").'.cookiename'));
        $activate = $site->findId(config('sites.'.$request->input("board").'.editurlbegin'), config('sites.'.$request->input("board").'.editurlend'), $profile);
        $act = 'http://rydo.ru';
        $act .= $activate;
        $activ = $site->GetPage($curl, $act, config('sites'.$request->input("board").'.cookiename'));
        curl_close($curl);
        $act = str_replace('/activate/', '', $act);
        $site->SaveToDB($request->input("num"),$request->input("board"),$title, $act);
    }
    public function goods(Request $request)
    {
        $price = Board::getPrice($request->input("num"));
        $descr = DB::table('dgimc_posts')->where('ID', $request->input("num"))->value('post_excerpt');
        $descr = Board::getDescr($descr);
        $title = DB::table('dgimc_posts')->where('ID', $request->input("num"))->value('post_title');
        $title = Board::getTitle($title);
        $curl = curl_init();
        $site = new Sites;
        $ch = curl_init();
        $imglink = Board::getImage($request->input("num"));
        $fname = $site->dlImg($ch, $imglink);
        curl_close($ch);
        $data = new \CurlFile($fname, mime_content_type($fname), basename($fname));
        $auth = $site->SiteAuth($curl, config('sites.'.$request->input("board").'.post'), config('sites.'.$request->input("board").'.loginurl'), config('sites'.$request->input("board").'.cookiename'));
        $postcr[] = '';
        $postcr = config('sites.'.$request->input("board").'.postcr');
        $postcr[config('sites.'.$request->input("board").'.postprice')] = $price;
        $postcr[config('sites.'.$request->input("board").'.postdescr')] = $descr;
        $postcr[config('sites.'.$request->input("board").'.posttitle')] = $title;
        $postcr['pic1'] = $data;
        $oblink = $site->uploadImg($curl, config('sites.'.$request->input("board").'.posturl'), $postcr, config('sites'.$request->input("board").'.cookiename'));
        $obnum = $site->findId(config('sites.'.$request->input("board").'.editurlbegin'), config('sites.'.$request->input("board").'.editurlend'), $oblink);
        curl_close($curl);
        $site->SaveToDB($request->input("num"),$request->input("board"),$title, $obnum);
    }
    public function kuraga(Request $request)
    {
        $price = Board::getPrice($request->input("num"));
        $descr = DB::table('dgimc_posts')->where('ID', $request->input("num"))->value('post_excerpt');
        $descr = Board::getDescr($descr);
        $title = DB::table('dgimc_posts')->where('ID', $request->input("num"))->value('post_title');
        $title = Board::getTitle($title);
        $curl = curl_init();
        $site = new Sites;
        $ch = curl_init();
        $imglink = Board::getImage($request->input("num"));
        $fname = $site->dlImg($ch, $imglink);
        curl_close($ch);
        $data = new \CurlFile($fname, mime_content_type($fname), basename($fname));
        $auth = $site->SiteAuth($curl, config('sites.'.$request->input("board").'.post'), config('sites.'.$request->input("board").'.loginurl'), config('sites'.$request->input("board").'.cookiename'));
        $postcr[] = '';
        $postcr = config('sites.'.$request->input("board").'.postcr');
        $postcr[config('sites.'.$request->input("board").'.postprice')] = $price;
        $postcr[config('sites.'.$request->input("board").'.postdescr')] = $descr;
        $postcr[config('sites.'.$request->input("board").'.posttitle')] = $title;
        $postcr['pic1'] = $data;
        $oblink = $site->uploadImg($curl, config('sites.'.$request->input("board").'.posturl'), $postcr, config('sites'.$request->input("board").'.cookiename'));
        $obnum = $site->findId(config('sites.'.$request->input("board").'.editurlbegin'), config('sites.'.$request->input("board").'.editurlend'), $oblink);
        curl_close($curl);
        $site->SaveToDB($request->input("num"),$request->input("board"),$title, $obnum);
    }
    public function gorodets(Request $request)
    {
        $price = Board::getPrice($request->input("num"));
        $descr = DB::table('dgimc_posts')->where('ID', $request->input("num"))->value('post_excerpt');
        $descr = Board::getDescr($descr);
        $title = DB::table('dgimc_posts')->where('ID', $request->input("num"))->value('post_title');
        $title = Board::getTitle($title);
        $curl = curl_init();
        $site = new Sites;
        $ch = curl_init();
        $imglink = Board::getImage($request->input("num"));
        $fname = $site->dlImg($ch, $imglink);
        curl_close($ch);
        $data = new \CurlFile($fname, mime_content_type($fname), basename($fname));
        $auth = $site->SiteAuth($curl, config('sites.'.$request->input("board").'.post'), config('sites.'.$request->input("board").'.loginurl'), config('sites'.$request->input("board").'.cookiename'));
        $postimg[] = '';
        $postimg = config('sites.'.$request->input("board").'.postuploadimg');
        $postimg[config('sites.'.$request->input("board").'.postprice')] = $price;
        $postimg[config('sites.'.$request->input("board").'.postdescr')] = $descr;
        $postimg[config('sites.'.$request->input("board").'.posttitle')] = $title;
        $postimg['info-image[]'] = $data;
        $postcr[] = '';
        $postcr = config('sites.'.$request->input("board").'.postcr');
        $postcr[config('sites.'.$request->input("board").'.postprice')] = $price;
        $postcr[config('sites.'.$request->input("board").'.postdescr')] = $descr;
        $postcr[config('sites.'.$request->input("board").'.posttitle')] = $title;
        $img = $site->uploadImg($curl, config('sites.'.$request->input("board").'.urlupload'), $postimg, config('sites'.$request->input("board").'.cookiename'));
        $imglink = $site->findId('file":"', '","thumb' , $img);
        $imglink = str_replace('\\', '', $imglink);
        $postcr['info-image'] = $imglink;
        $oblink = $site->uploadImg($curl, config('sites.'.$request->input("board").'.posturl'), $postcr, config('sites'.$request->input("board").'.cookiename'));
        $obnum = $site->findId(config('sites.'.$request->input("board").'.editurlbegin'), config('sites.'.$request->input("board").'.editurlend'), $oblink);
        curl_close($curl);
        $site->SaveToDB($request->input("num"),$request->input("board"),$title, $obnum);
    }
    public function sar164(Request $request)
    {
        $price = Board::getPrice($request->input("num"));
        $descr = DB::table('dgimc_posts')->where('ID', $request->input("num"))->value('post_excerpt');
        $descr = Board::getDescr($descr);
        $title = DB::table('dgimc_posts')->where('ID', $request->input("num"))->value('post_title');
        $title = Board::getTitle($title);
        $curl = curl_init();
        $site = new Sites;
        $ch = curl_init();
        $imglink = Board::getImage($request->input("num"));
        $fname = $site->dlImg($ch, $imglink);
        curl_close($ch);
        $data = new \CurlFile($fname, mime_content_type($fname), basename($fname));
        $auth = $site->SiteAuth($curl, config('sites.'.$request->input("board").'.post'), config('sites.'.$request->input("board").'.loginurl'), config('sites'.$request->input("board").'.cookiename'));
        $oblink = $site->GetPage($curl, config('sites.'.$request->input("board").'.posturl'), config('sites'.$request->input("board").'.cookiename'));
        $obnum = $site->findId(',\'sid\':', ',\'city\':\'saratov\'', $oblink);
        $urlupload = config('sites.'.$request->input("board").'.urlupload');
        $urlupload .= '&sid='.$obnum;
        $urlupload .= '&qqfile='.$fname;
        $postimg[] = $data;
        $img = $site->uploadImg($curl, config('sites.'.$request->input("board").'.urlupload'), $postimg, config('sites'.$request->input("board").'.cookiename'));
        $imgid = $site->findId('\'dbFileId\':', ',\'hasPreview\'' , $img);
        $postcr[] = '';
        $descrwin = mb_convert_encoding($descr,"Windows-1251", "UTF-8");
        $titlewin = mb_convert_encoding($title,"Windows-1251", "UTF-8");
        $postcr = config('sites.'.$request->input("board").'.postcr');
        $postcr[config('sites.'.$request->input("board").'.postprice')] = $price;
        $postcr[config('sites.'.$request->input("board").'.postdescr')] = $descrwin;
        $postcr[config('sites.'.$request->input("board").'.posttitle')] = $titlewin;
        $postcr['user_name'] = mb_convert_encoding('МАГАЗИН ПОДАРКОВ',"Windows-1251", "UTF-8");
        $postcr['p_id'] = $obnum;
        $postcr['files_uploadedFilesId'] = $imgid;
        $ob = $site->uploadImg($curl, config('sites.'.$request->input("board").'.posturl'), $postcr, config('sites'.$request->input("board").'.cookiename'));
        $obl = $site->findId(config('sites.'.$request->input("board").'.editurlbegin'), config('sites.'.$request->input("board").'.editurlend'), $ob);
        $obl = 'http://'.$obl;
        curl_close($curl);
        $site->SaveToDB($request->input("num"),$request->input("board"),$title, $obl);
    }
    public function itebe(Request $request)
    {
        $price = Board::getPrice($request->input("num"));
        $descr = DB::table('dgimc_posts')->where('ID', $request->input("num"))->value('post_excerpt');
        $descr = Board::getDescr($descr);
        $title = DB::table('dgimc_posts')->where('ID', $request->input("num"))->value('post_title');
        $title = Board::getTitle($title);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $site = new Sites;
        $ch = curl_init();
        $imglink = Board::getImage($request->input("num"));
        $fname = $site->dlImg($ch, $imglink);
        curl_close($ch);
        $data = new \CurlFile($fname, mime_content_type($fname), basename($fname));
        $auth = $site->SiteAuth($curl, config('sites.'.$request->input("board").'.post'), config('sites.'.$request->input("board").'.loginurl'), config('sites'.$request->input("board").'.cookiename'));
        $gettoken = $site->GetPage($curl, config('sites.'.$request->input("board").'.tokenurl'), config('sites'.$request->input("board").'.cookiename'));
        $token = $site->findId(config('sites.'.$request->input("board").'.tokenbegin'), config('sites.'.$request->input("board").'.tokenend'), $gettoken);
        $postcr = config('sites.'.$request->input("board").'.postcr');
        $postcr[config('sites.'.$request->input("board").'.postprice')] = $price;
        $postcr[config('sites.'.$request->input("board").'.postdescr')] = $descr;
        $postcr[config('sites.'.$request->input("board").'.posttitle')] = $title;
        $postcr[config('sites.'.$request->input("board").'.posttitle2')] = mb_substr($descr, 0, 30);
        $postcr['f1'] = $data;
        $postaccept = config('sites.'.$request->input("board").'.postaccept');
        $postaccept['dirtmp'] = date('Y_m_d');
        $postaccept['token'] = $token;
        $ob = $site->uploadImg($curl, config('sites.'.$request->input("board").'.posturl'), $postcr, config('sites'.$request->input("board").'.cookiename'));
        $oblink = $site->uploadImg($curl, config('sites.'.$request->input("board").'.posturl'), $postaccept, config('sites'.$request->input("board").'.cookiename'));
        $obnum = $site->findId(config('sites.'.$request->input("board").'.editurlbegin'), config('sites.'.$request->input("board").'.editurlend'), $oblink);
        curl_close($curl);
        $site->SaveToDB($request->input("num"),$request->input("board"),$title, $obnum);
    }
    public function zpost(Request $request)
    {
        $price = Board::getPrice($request->input("num"));
        $descr = DB::table('dgimc_posts')->where('ID', $request->input("num"))->value('post_excerpt');
        $descr = Board::getDescr($descr);
        $title = DB::table('dgimc_posts')->where('ID', $request->input("num"))->value('post_title');
        $title = Board::getTitle($title);
        $curl = curl_init();
        $site = new Sites;
        $ch = curl_init();
        $imglink = Board::getImage($request->input("num"));
        $fname = $site->dlImg($ch, $imglink);
        curl_close($ch);
        $data = new \CurlFile($fname, mime_content_type($fname), basename($fname));
        $auth = $site->SiteAuth($curl, config('sites.'.$request->input("board").'.post'), config('sites.'.$request->input("board").'.loginurl'), config('sites'.$request->input("board").'.cookiename'));
        $postcr = config('sites.'.$request->input("board").'.postcr');
        $postcr[config('sites.'.$request->input("board").'.postprice')] = $price;
        $postcr[config('sites.'.$request->input("board").'.postdescr')] = $descr;
        $postcr[config('sites.'.$request->input("board").'.posttitle')] = $title;
        $postcr['foto[]'] = $data;
        $postimg['foto[]'] = $data;
        $uploadph = $site->uploadImg($curl, 'http://zoompost.ru/blok/upload_file_add.php', $postimg, config('sites'.$request->input("board").'.cookiename'));
        $ob = $site->uploadImg($curl, config('sites.'.$request->input("board").'.posturl'), $postcr, config('sites'.$request->input("board").'.cookiename'));
        $obnum = $site->GetPage($curl, config('sites.'.$request->input("board").'.accepturl'), config('sites'.$request->input("board").'.cookiename'));
        curl_close($curl);
        $site->SaveToDB($request->input("num"),$request->input("board"),$title, 'http://zoompost.ru/user/b_user.php');
    }
    public function apipost(Request $request)
    {
        $price = Board::getPrice($request->input("num"));
        $descr = DB::table('dgimc_posts')->where('ID', $request->input("num"))->value('post_excerpt');
        $descr = Board::getDescr($descr);
        $title = DB::table('dgimc_posts')->where('ID', $request->input("num"))->value('post_title');
        $title = Board::getTitle($title);
        $curl = curl_init();
        $site = new Sites;
        $ch = curl_init();
        $imglink = Board::getImage($request->input("num"));
        $fname = $site->dlImg($ch, $imglink);
        curl_close($ch);
        $data = new \CurlFile($fname, mime_content_type($fname), basename($fname));
        $auth = $site->SiteAuth($curl, config('sites.'.$request->input("board").'.post'), config('sites.'.$request->input("board").'.loginurl'), config('sites'.$request->input("board").'.cookiename'));
        $postcr = config('sites.'.$request->input("board").'.postcr');
        $postcr[config('sites.'.$request->input("board").'.postprice')] = $price;
        $postcr[config('sites.'.$request->input("board").'.postdescr')] = $descr;
        $postcr[config('sites.'.$request->input("board").'.posttitle')] = $title;
        $postcr['foto[]'] = $data;
        $postimg['foto[]'] = $data;
        $k = $site->GetPage($curl, config('sites.'.$request->input("board").'.posturl'), config('sites'.$request->input("board").'.cookiename'));
        $kp = $site->findId(config('sites.'.$request->input("board").'.editurlbegin'), config('sites.'.$request->input("board").'.editurlend'), $k);
        $postcr['dop_kp'] = $kp;
        $uploadph = $site->uploadImg($curl, 'http://apipost.ru/obyavleniya/blok/upload_file_add.php', $postimg, config('sites'.$request->input("board").'.cookiename'));
        $ob = $site->uploadImg($curl, config('sites.'.$request->input("board").'.posturl'), $postcr, config('sites'.$request->input("board").'.cookiename'));
        $obnum = $site->findId(config('sites.'.$request->input("board").'.linkbegin'), config('sites.'.$request->input("board").'.linkend'), $ob);
        curl_close($curl);
        $site->SaveToDB($request->input("num"),$request->input("board"),$title, $obnum);
    }
}
