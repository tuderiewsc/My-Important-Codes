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



