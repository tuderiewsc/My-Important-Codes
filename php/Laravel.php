<?php
// differnet name for table //
class users extends Model
{
	protected  $guarded= [];
	protected $table= 'users_table';
}
// log in laravel //
if ($validate->fails()) {
	Log::error('کاربر با مشکل مواجه شد',['ip'=> $_SERVER['REMOTE_ADDR']]);
	return 'Fail';
}
// exists rule //
'emp_idd' => 'required|exists:employees_table,id',
// return view with message //
return view('dashboard.workingdata.create')->with('message','<script>alert("اطلاعات تکراری است!")</script>');
/* view */
@if(isset($message))
{!! $message !!}
@endif
/* view */
// control route //
@if (Route::has('register')) @endif
// multiple update in laravel //
DB::update('update books set sel = ?', ['0']);
// chunk in laravel // دریافت بخشی از نتایج
$category= Category::all();
$category = $category->chunk(round($category->count() / 3))
// path Slug //
public function pathSlug()
{
  return url('/')."/single/video/$this->slug";
}
Log::info('message',['username'=>$_POST['username']]);
Log::error('کاربر با مشکل مواجه شد',['ip'=> $_SERVER['REMOTE_ADDR']]);
return view('test.test', array('name' => 'ali31'));
define('SESSION_EXPIRATION_TIME', 30*60);
$employee= employees::findorfail($id);
@unlink("upload/images/".$pic_name);
$userslist= User::all()->pluck('username','email');
$cat= Category::all()->pluck('name','id');



public function __construct()
{
    $this->middleware('guest')->except('logout');
}

Mail::to($user->email)->send(new VerifyMail($user));

if (strpos($input_empidd, '-')) {
   $str= explode('-', $input_empidd);
   $str= reset($str);
   $str= substr($str, 1, strlen($str));
}


public function autocomplete($id)
{
 $result= DB::table('employees_table')->where('emp_id','like',"%$id%")->orderBy('emp_id')->get();
       //$result= DB::select('select * from employees_table where emp_id LIKE ?', ["%$id%"]);
 $array1= array();
 $array2= array();
 $array3= array();
 $data= array();
 foreach ($result as $key=>$value) {
    $array1[$key]= $value->emp_id;
    $array2[$key]= $value->fname;
    $array3[$key]= $value->lname;
    array_push($data,$array1[$key].'-'.$array2[$key].' '.$array3[$key]);
}
echo json_encode($data);
}

// Middleware
class isadmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (\Auth::check()) {
            if (!\Auth::user()->check_role()) {
                return redirect('/');
            }else {
                return $next($request);
            }
        }else {
            return redirect('/');
        }
    }
}
/* User Model */
public function check_role()
{
    if ($this->role->name=='administrator') {
        return true;
    }else {
        return false;
    }
}
---------------
	/**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'emp_id' => 'required|unique:employees_table',
            'lname' => 'required',
            'fname' => 'required',
            'idnum' => 'required|unique:employees_table|size:10',
            'img' => 'required|mimes:jpeg,jpg,png,bmp',
            'path' => 'required|mimes:pdf',
            'childs_no' => 'required|max:10|min:0',
        ];
    }

    <div class="form-group form-check-inline my-4">
    <label class="form-check-label" for="remember" style="font-size: .75rem;">
    &nbsp;&nbsp;مرا به خاطر بسپار
    <input type="checkbox" name="remember" id="remember" class="form-check-input float-right" {{ old('remember') ? 'checked' : '' }}>
    </label>
    </div>


    Session::flash('delete_success','پاک کردن موفق');
    @if(\Session::has('delete_success'))
    <div class="alert alert-success my-2 w-75" style="margin: 0 auto;">{{ \Session::get('delete_success') }}</div>
    @endif



    $dis= Discount::find($id);
    $dis->name= $request->input('name');
    $dis->percent= $request->input('percent');
    $dis->save();
       // $dis= Discount::find($id)->update($request->all());


    session()->forget('id_list');
    foreach ($books as $book){
        session()->push('id_list',$book->id);
            //session()->put('id_list',$book->id);
    }

    return abort(403);

    Basket::where('user_id',\Auth::user()->id)->where('type','book')->delete();
    $lastbooks= Book::latest()->orderBy('id','DESC')->take(6)->get();
    $lastvideos= Video::latest()->orderBy('id','DESC')->limit(6)->get();
		//Realations
    $videos= $cat->videos()->latest()->paginate(6);
    $books= $cat->book()->latest()->paginate(6);
		//Realations

    @foreach ($video->categories()->pluck('name') as $cat)
    <p>{{ $cat }}</p><br>
    @endforeach


    public function sitemap(){
        $path=SitemapGenerator::create('http://localhost:8000/');

    }

    public function Ajax_search($phrase)
    {
        $books= Book::where('title','like','%'.$phrase.'%')->get();
        $videos= Video::where('title','like','%'.$phrase.'%')->get();
        $array = $data = [];
        foreach ($books as $key=>$value) {
            $array[$key]= $value->title;
            array_push( $data , $array[$key] );
        }
        foreach ($videos as $key=>$value) {
            $array[$key]= $value->title;
            array_push( $data , $array[$key] );
        }
        echo json_encode($data);

    }


    class AppServiceProvider extends ServiceProvider
    {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer(['site.section.header','auth.section.header'],function ($view){
            $menu= Category::with('getChild')->where('parent_id',0)->get();
            if (! \Auth::guest()) {
                $count= Basket::where('user_id',\Auth::user()->id)->count();

            }else {
                $count= 0;
            }
            $view->with(compact('menu','count')) ;
        });
    }
}

class Book extends Model
{
	//protected $guarded= [];
    public function setDescriptionAttribute($data)
    {
        // next line
     $this->attributes['description']= str_replace(PHP_EOL, '<br>', $data);
 }
}


public function user()
{
    return $this->belongsTo(User::class)
    ->select(['id','username']);
}


<td>{{ mb_strimwidth($book->description,0,30,'---') }}</td>

@if (!empty($books[0]))

<div style="margin:0 auto;text-align: center">{!! $books->onEachSide(5)->links() !!}</div>


public function upload(Request $request){
    if(! empty($_FILES['video']['name'])){
        $file = $request->video;
        $filename = $_FILES['video']['name'];
        $filetype = $_FILES['video']['type'];
        $filetemp = $_FILES['video']['tmp_name'];

        $filename = microtime() . '-' . $file->getClientOriginalName();
        $file = $file->move(public_path().'\uploads\videos', $filename);
        if($file){
            if (session()->has('videoID')){
                $id = session()->get('videoID');
                $video = Video::find($id);
                $array = [];
                $video->update(array_merge($array, ['video'=>$filename]));
            }
            return 'آپلود موفق';
        }else{
            return 'خطا در آپلود';
        }
    }
}


$password= Hash::make($request->password , ['rounds'=>12]);

return back()->with('delete_success', 'آیتم با موفقیت پاک شد.');


$spec = ProductData::findorfail($id);
$data = [];
$data['title'] = $spec->title;
$data['product_id'] = $spec->product_id;
$data['spec_id'] = $spec->id;
echo json_encode($data);



public function cat_bulk_delete(Request $request){
    $counter = 0;
    $catLength = 0;
    foreach (json_decode($request['ids']) as $data => $value)
    {
        $counter++;
        $cats = Category::where('id', $value);
        $res = $cats->delete();
        if ($res){
            $catLength++;
        }
    }
    if ($counter === $catLength){
        echo 1;
        Toastr::success('delete success');
    }else{
        echo 0;
    }

}


return response(json_encode('حذف موفق'));


$array[0] = $cat->id;
foreach ($catChilds as $key => $value) {
    $array[$key + 1] = $value->id;
}
$products = Product::whereIn('category_id', $array)->orderBy($col, $sort)->paginate($paginate);


if(strpos($str,"'") === false){
    $phrase = $str;
}else{
    $phrase = preg_replace("/[']/", "", $str);
}



use App\Mail\ContactUsMail;
Mail::to('wizard2070@gmail.com')
->send(new ContactUsMail($user, $name, $email, $message));



$product_ids = [];
foreach ($user_products as $user_product){
    array_push($product_ids, $user_product->product_id);
}


$user_ip = request()->ip();


@extends('site.layouts.master')

@section('keywords', 'Shop, market, category')
@section('description', 'جستجوي محصولات فروشگاه')

@section('title')
جستجو در سايت
@endsection



@if(isset($message))
{!! $message !!}
@endif


@if(sizeof($videos) != 0 )
@if (count($product->product_galleries) >0)


/* Api */
public function index()
{
    $articles = Article::with('user')->latest()->paginate(4);
    return $articles;
    return response()->json(['data' => $articles]);
}

if ($validator->fails()) {
    return response([
        'status' => 'error',
        'message' => $validator->errors()
    ], 300);
}

public function urlparam(Request $request){
        // Example url = http://127.0.0.1:8000/api/urlparams?sortBy=C&page=2&test=ali
    if ($request->sortBy != null){
        $res =array(
            'sortBy'=>$request->sortBy,
            'page'=>$request->page,
            'test'=>$request->test
        );
        return response()->json([ 'result' => $res]);
    }else{
        return response()->json(['result' => 'No Data']);
    }

}

public function uploadImage(Request $request)
{
        //return dd($request->section);

    $year = Carbon::now()->year;

    foreach ($request->file('images') as $file) {
        $image_path = "\upload\image";
        $file_name = time() . '-' . $year . '-' . $file->getClientOriginalName();
        $file->storeAs($image_path, $file_name, 'public_local');
            // $path = $file->store($image_path, 'public_local');
        $res = imageUploader::create(array_merge($request->all(), ['image' => $file_name]));
    }

    if ($res) {
        $request->session()->flash('uploadSuccess', 'آپلود موفق');
    }

    return redirect()->back();
}
/* Api */


/* Constants */
$redirect_url = Config::get('constants.redirect_url');
//constants.php =>
'redirect_url' => env('REDIRECT_URL','http://192.168.30.99/wordpress/wp-login.php?redirect_to=http://192.168.30.99/auth/public/'),
/* Constants */


public function changeLang(Request $request)
	{
		$lan = $request->lan;
		session()->forget('lang');
		if ($lan == 'fa'){
			session()->put('lang', 0);
			App::setLocale('fa');
			echo 0;
		}elseif($lan == 'en'){
			session()->put('lang', 1);
			App::setLocale('en');
			echo 1;
		}

	}
	
	public function notif_bulk_status_read(Request $request)
	{
		$counter = 0;
		$notifLength = 0;
		foreach (json_decode($request->ids) as $data => $value)
		{
			$counter++;
			$notif = Notification::find($value);
			$notif->status = 'read';
			$res = $notif->save();
			if ($res){
				$notifLength++;
			}
		}
		if ($counter === $notifLength){
			session()->flash('status_change_success');
			return 1;
		}else{
			return 0;
		}
	}
	
	
	/* Auto Auth Middleware */
	public function handle($request, Closure $next)
	{

		if (isset($_COOKIE['wordpress_8L25432ACC2D4A404E635266556A58CC'])){
			$data = unserialize($_COOKIE['wordpress_8L25432ACC2D4A404E635266556A58CC'], ["allowed_classes" => false]);
			$userId = $this->encrypt_decrypt('decrypt', $data['userId']);
			$userRole = $this->encrypt_decrypt('decrypt', $data['userRole']);
			$user = User::find($userId);
			session()->put('laravel_auth_check', 1);
			session()->put('user_role', $userRole);
			session()->put('user', $user);
		}else{
			Auth::logout();
			session()->forget('laravel_auth_check');
			session()->forget('user_role');
			session()->forget('user');
		}

		return $next($request);
	}

	function encrypt_decrypt($action, $string) {
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$secret_key = 'H+MbQeThWmYq3t6w9z$C&F)J@NcRfUjXn2r5u7x!A%D*G-KaPdSgVkYp3s6v9y/B';
		$secret_iv = 'RfUjXn2r5u8x/A?D(G-KaPdSgVkYp3s6v9y$B&E)H@MbQeThWmZq4t7w!z%C*F-J';
		$key = hash('sha256', $secret_key);
		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);
		if ( $action == 'encrypt' ) {
			$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);
		} else if( $action == 'decrypt' ) {
			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		}
		return $output;
	}
	/* Auto Auth Middleware */
	
	
	  <meta name="csrf-token" content="{{ csrf_token() }}">
	  $.ajax({
			url: url,
			type: 'POST',
			data: { 'user_id': userId, '_token': $('meta[name="csrf-token"]').attr('content') },
			dataType: 'JSON',
			success: function (data) {
				//console.log(data);
			}, error:function (err) {
				//console.log(err);
			}
		});
		
		
	  <?php
	//App::setLocale('fa');
	$locale = App::getLocale();
	?>
  @if($locale=='fa')
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/style_rtl.css') }}" />
  @elseif($locale=='en')
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/style_ltr.css') }}" />
  @endif
  
  
	  
		
		
		
	<form method="post" action="{{ route('customer_orders.update' , ['customer_order'=>$order->id]) }}" >
      //@csrf
	  {{csrf_field()}}
      {{ method_field('PATCH') }}
	  //{{method_field('delete')}}

	
	<p><span>{{ date('d/m/Y', strtotime($order_sendToAdmin_notif_date->created_at ))}}</span></p>

		

