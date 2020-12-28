<?php
// Refresh page timing //
echo '<meta http-equiv="refresh" content="1;url=http://localhost:8000" />'
----------------------
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
	