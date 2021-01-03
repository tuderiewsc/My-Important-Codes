<?php
// differnet name for table //
class users extends Model
{
	protected  $guarded= [];
	protected $table= 'users_table';
}
----------------------
// log in laravel //
if ($validate->fails()) {
	Log::error('کاربر با مشکل مواجه شد',['ip'=> $_SERVER['REMOTE_ADDR']]);
	return 'Fail';
}
----------------------
// exists rule //
'emp_idd' => 'required|exists:employees_table,id',
----------------------
// return view with message //
return view('dashboard.workingdata.create')->with('message','<script>alert("اطلاعات تکراری است!")</script>');
/* view */
@if(isset($message))
{!! $message !!}
@endif
/* view */
----------------------
// control route //
@if (Route::has('register')) @endif
----------------------
// multiple update in laravel //
DB::update('update books set sel = ?', ['0']);
----------------------
// chunk in laravel // دریافت بخشی از نتایج
$category= Category::all();
$category = $category->chunk(round($category->count() / 3))
----------------------
// path Slug //
public function pathSlug()
	{
		return url('/')."/single/video/$this->slug";
	}
----------------------
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
