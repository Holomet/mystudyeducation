<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
	return view('home.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['auth']],function(){
	Route::get('/admin/dashboard', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.dashboard');

	Route::get('/admin/roles', [App\Http\Controllers\Admin\RolesController::class, 'index'])->name('admin.roles');
	Route::post('admin/roles/paginate', [App\Http\Controllers\Admin\RolesController::class, 'paginate'])->name('admin.roles.paginate');
	Route::get('admin/roles/add', [App\Http\Controllers\Admin\RolesController::class, 'add'])->name('admin.roles.add');
	Route::post('admin/roles/create', [App\Http\Controllers\Admin\RolesController::class, 'create'])->name('admin.roles.create');
	Route::get('admin/roles/edit/{id}', [App\Http\Controllers\Admin\RolesController::class, 'edit'])->name('admin.roles.edit');
	Route::post('admin/roles/update', [App\Http\Controllers\Admin\RolesController::class, 'update'])->name('admin.roles.update');
	Route::get('admin/roles/delete/{id}', [App\Http\Controllers\Admin\RolesController::class, 'delete'])->name('admin.roles.delete');

	Route::get('admin/users/index', [App\Http\Controllers\Admin\UsersController::class, 'index'])->name('admin.users');
	Route::post('admin/users/paginate', [App\Http\Controllers\Admin\UsersController::class, 'paginate'])->name('admin.users.paginate');
	Route::get('admin/users/add', [App\Http\Controllers\Admin\UsersController::class, 'add'])->name('admin.users.add');
	Route::post('admin/users/create', [App\Http\Controllers\Admin\UsersController::class, 'create'])->name('admin.users.create');
	Route::get('admin/users/view/{id}', [App\Http\Controllers\Admin\UsersController::class, 'view'])->name('admin.users.view');
	Route::get('admin/users/edit/{id}', [App\Http\Controllers\Admin\UsersController::class, 'edit'])->name('admin.users.edit');
	Route::post('admin/users/update', [App\Http\Controllers\Admin\UsersController::class, 'update'])->name('admin.users.update');
	Route::get('admin/users/delete/{id}', [App\Http\Controllers\Admin\UsersController::class, 'delete'])->name('admin.users.delete');
	Route::get('admin/users/resetpassword/{id}', [App\Http\Controllers\Admin\UsersController::class, 'resetPassword'])->name('admin.users.resetpassword');
	Route::post('admin/users/updatepassword', [App\Http\Controllers\Admin\UsersController::class, 'updatePassword'])->name('admin.users.updatepassword');

	Route::get('admin/expo', [App\Http\Controllers\Admin\ExpoController::class, 'index'])->name('admin.expo');
	Route::post('admin/expo/paginate', [App\Http\Controllers\Admin\ExpoController::class, 'paginate'])->name('admin.expo.paginate');
	Route::get('admin/expo/add', [App\Http\Controllers\Admin\ExpoController::class, 'add'])->name('admin.expo.add');
	Route::post('admin/expo/create', [App\Http\Controllers\Admin\ExpoController::class, 'create'])->name('admin.expo.create');
	Route::get('admin/expo/view/{id}', [App\Http\Controllers\Admin\ExpoController::class, 'view'])->name('admin.expo.view');
	Route::get('admin/expo/edit/{id}', [App\Http\Controllers\Admin\ExpoController::class, 'edit'])->name('admin.expo.edit');
	Route::post('admin/expo/update', [App\Http\Controllers\Admin\ExpoController::class, 'update'])->name('admin.expo.update');
	Route::get('admin/expo/delete/{id}', [App\Http\Controllers\Admin\ExpoController::class, 'delete'])->name('admin.expo.delete');

	Route::get('admin/expo/addzone/{id}', [App\Http\Controllers\Admin\ExpoController::class, 'addZone'])->name('admin.expo.addzone');
	Route::post('admin/expo/createzone', [App\Http\Controllers\Admin\ExpoController::class, 'createZone'])->name('admin.expo.createzone');
	Route::get('admin/expo/viewzone/{id}', [App\Http\Controllers\Admin\ExpoController::class, 'viewZone'])->name('admin.expo.viewzone');
	Route::get('admin/expo/editzone/{id}', [App\Http\Controllers\Admin\ExpoController::class, 'editZone'])->name('admin.expo.editzone');
	Route::post('admin/expo/updatezone', [App\Http\Controllers\Admin\ExpoController::class, 'updateZone'])->name('admin.expo.updatezone');
	Route::get('admin/expo/deletezone/{id}', [App\Http\Controllers\Admin\ExpoController::class, 'deleteZone'])->name('admin.expo.deletezone');
	Route::get('admin/expo/states/{id}',[App\Http\Controllers\Admin\ExpoController::class, 'expoStates'])->name('admin.expo.getstates');

	Route::get('admin/course/categories', [App\Http\Controllers\Admin\CourseCategoriesController::class, 'index'])->name('admin.courses.categories');
	Route::post('admin/courses/categories/paginate', [App\Http\Controllers\Admin\CourseCategoriesController::class, 'paginate'])->name('admin.courses.categories.paginate');
	Route::get('admin/courses/categories/add', [App\Http\Controllers\Admin\CourseCategoriesController::class, 'add'])->name('admin.courses.categories.add');
	Route::post('admin/courses/categories/create', [App\Http\Controllers\Admin\CourseCategoriesController::class, 'create'])->name('admin.courses.categories.create');
	Route::get('admin/courses/categories/view/{id}', [App\Http\Controllers\Admin\CourseCategoriesController::class, 'view'])->name('admin.courses.categories.view');
	Route::get('admin/courses/categories/edit/{id}', [App\Http\Controllers\Admin\CourseCategoriesController::class, 'edit'])->name('admin.courses.categories.edit');
	Route::post('admin/courses/categories/update', [App\Http\Controllers\Admin\CourseCategoriesController::class, 'update'])->name('admin.courses.categories.update');
	Route::get('admin/courses/categories/delete/{id}', [App\Http\Controllers\Admin\CourseCategoriesController::class, 'delete'])->name('admin.courses.categories.delete');


	Route::get('admin/courses', [App\Http\Controllers\Admin\CourseController::class, 'index'])->name('admin.courses');
	Route::post('admin/courses/paginate', [App\Http\Controllers\Admin\CourseController::class, 'paginate'])->name('admin.courses.paginate');
	Route::get('admin/courses/add', [App\Http\Controllers\Admin\CourseController::class, 'add'])->name('admin.courses.add');
	Route::post('admin/courses/create', [App\Http\Controllers\Admin\CourseController::class, 'create'])->name('admin.courses.create');
	Route::get('admin/courses/view/{id}', [App\Http\Controllers\Admin\CourseController::class, 'view'])->name('admin.courses.view');
	Route::get('admin/courses/edit/{id}', [App\Http\Controllers\Admin\CourseController::class, 'edit'])->name('admin.courses.edit');
	Route::post('admin/courses/update', [App\Http\Controllers\Admin\CourseController::class, 'update'])->name('admin.courses.update');
	Route::get('admin/courses/delete/{id}', [App\Http\Controllers\Admin\CourseController::class, 'delete'])->name('admin.courses.delete');
	Route::get('admin/courses/list/{id}', [App\Http\Controllers\Admin\CourseController::class, 'courseList'])->name('admin.courses.courselist');

	Route::get('admin/collages', [App\Http\Controllers\Admin\CollageController::class, 'index'])->name('admin.collages');
	Route::post('admin/collages/paginate', [App\Http\Controllers\Admin\CollageController::class, 'paginate'])->name('admin.collages.paginate');
	Route::get('admin/collages/add', [App\Http\Controllers\Admin\CollageController::class, 'add'])->name('admin.collages.add');
	Route::post('admin/collages/create', [App\Http\Controllers\Admin\CollageController::class, 'create'])->name('admin.collages.create');
	Route::get('admin/collages/view/{id}', [App\Http\Controllers\Admin\CollageController::class, 'view'])->name('admin.collages.view');
	Route::get('admin/collages/edit/{id}', [App\Http\Controllers\Admin\CollageController::class, 'edit'])->name('admin.collages.edit');
	Route::post('admin/collages/update', [App\Http\Controllers\Admin\CollageController::class, 'update'])->name('admin.collages.update');
	Route::get('admin/collages/delete/{id}', [App\Http\Controllers\Admin\CollageController::class, 'delete'])->name('admin.collages.delete');

	Route::get('admin/collages/changelogo/{id}', [App\Http\Controllers\Admin\CollageController::class, 'changeLogo'])->name('admin.collages.changelogo');
	Route::post('admin/collages/updatelogo', [App\Http\Controllers\Admin\CollageController::class, 'updateLogo'])->name('admin.collages.updatelogo');

	Route::get('admin/collages/changerollupbanner/{id}', [App\Http\Controllers\Admin\CollageController::class, 'changerollupbanner'])->name('admin.collages.changerollupbanner');
	Route::post('admin/collages/updaterollupbanner', [App\Http\Controllers\Admin\CollageController::class, 'updateRollupBanner'])->name('admin.collages.updaterollupbanner');

	Route::get('admin/collages/changestallvideo/{id}', [App\Http\Controllers\Admin\CollageController::class, 'changestallvideo'])->name('admin.collages.changestallvideo');
	Route::post('admin/collages/updatestallvideo', [App\Http\Controllers\Admin\CollageController::class, 'updatestallvideo'])->name('admin.collages.updatestallvideo');

	Route::get('admin/collages/changeprospectus/{id}', [App\Http\Controllers\Admin\CollageController::class, 'changeprospectus'])->name('admin.collages.changeprospectus');
	Route::post('admin/collages/updateprospectus', [App\Http\Controllers\Admin\CollageController::class, 'updateprospectus'])->name('admin.collages.updateprospectus');


	Route::get('admin/collages/courses/{id}', [App\Http\Controllers\Admin\CollageCourseController::class, 'index'])->name('admin.collages.courses');
	Route::post('admin/collages/courses/paginate', [App\Http\Controllers\Admin\CollageCourseController::class, 'paginate'])->name('admin.collages.courses.paginate');
	Route::get('admin/collages/courses/add/{id}', [App\Http\Controllers\Admin\CollageCourseController::class, 'add'])->name('admin.collages.courses.add');
	Route::post('admin/collages/courses/create', [App\Http\Controllers\Admin\CollageCourseController::class, 'create'])->name('admin.collages.courses.create');
	Route::get('admin/collages/courses/edit/{id}', [App\Http\Controllers\Admin\CollageCourseController::class, 'edit'])->name('admin.collages.courses.edit');
	Route::post('admin/collages/courses/update', [App\Http\Controllers\Admin\CollageCourseController::class, 'update'])->name('admin.collages.courses.update');
	Route::get('admin/collages/courses/view/{id}', [App\Http\Controllers\Admin\CollageCourseController::class, 'view'])->name('admin.collages.courses.view');
	Route::get('admin/collages/courses/delete/{id}', [App\Http\Controllers\Admin\CollageCourseController::class, 'delete'])->name('admin.collages.courses.delete');

	Route::get('/admin/collages/gallery/{id}', [App\Http\Controllers\Admin\CollageGalleryController::class, 'index'])->name('admin.collages.gallery');
	Route::post('/admin/collages/gallery/paginate', [App\Http\Controllers\Admin\CollageGalleryController::class, 'paginate'])->name('admin.collages.gallery.paginate');
	Route::get('/admin/collages/gallery/add/{id}', [App\Http\Controllers\Admin\CollageGalleryController::class, 'add'])->name('admin.collages.gallery.add');
	Route::post('/admin/collages/gallery/create', [App\Http\Controllers\Admin\CollageGalleryController::class, 'create'])->name('admin.collages.gallery.create');
	Route::get('/admin/collages/gallery/edit/{id}', [App\Http\Controllers\Admin\CollageGalleryController::class, 'edit'])->name('admin.collages.gallery.edit');
	Route::post('/admin/collages/gallery/update', [App\Http\Controllers\Admin\CollageGalleryController::class, 'update'])->name('admin.collages.gallery.update');
	Route::get('/admin/collages/gallery/view/{id}', [App\Http\Controllers\Admin\CollageGalleryController::class, 'view'])->name('admin.collages.gallery.view');
	Route::get('/admin/collages/gallery/delete/{id}', [App\Http\Controllers\Admin\CollageGalleryController::class, 'delete'])->name('admin.collages.gallery.delete');
	Route::get('/admin/collages/gallery/addimage/{id}', [App\Http\Controllers\Admin\CollageGalleryController::class, 'addImage'])->name('admin.collages.gallery.addimage');
	Route::post('admin/collages/galleries/saveimage', [App\Http\Controllers\Admin\CollageGalleryController::class, 'saveImage'])->name('admin.collages.courses.image.save');
	Route::get('admin/collages/galleries/image/delete/{id}', [App\Http\Controllers\Admin\CollageGalleryController::class, 'deleteImage'])->name('admin.collages.gallery.image.delete');

	Route::get('/admin/collages/seminars/{id}', [App\Http\Controllers\Admin\CollageSeminarController::class, 'index'])->name('admin.collages.seminars');
	Route::post('/admin/collages/seminars/paginate', [App\Http\Controllers\Admin\CollageSeminarController::class, 'paginate'])->name('admin.collages.seminars.paginate');
	Route::get('/admin/collages/seminars/add/{id}', [App\Http\Controllers\Admin\CollageSeminarController::class, 'add'])->name('admin.collages.seminars.add');
	Route::post('/admin/collages/seminars/create', [App\Http\Controllers\Admin\CollageSeminarController::class, 'create'])->name('admin.collages.seminars.create');
	Route::get('/admin/collages/seminars/edit/{id}', [App\Http\Controllers\Admin\CollageSeminarController::class, 'edit'])->name('admin.collages.seminars.edit');
	Route::post('/admin/collages/seminars/update', [App\Http\Controllers\Admin\CollageSeminarController::class, 'update'])->name('admin.collages.seminars.update');
	Route::get('/admin/collages/seminars/view/{id}', [App\Http\Controllers\Admin\CollageSeminarController::class, 'view'])->name('admin.collages.seminars.view');
	Route::get('/admin/collages/seminars/delete/{id}', [App\Http\Controllers\Admin\CollageSeminarController::class, 'delete'])->name('admin.collages.seminars.delete');

	Route::get('admin/collages/courses/all', [App\Http\Controllers\Admin\CollageCourseController::class, 'courselist'])->name('admin.collages.courselist');
	Route::get('admin/collages/galleries/all', [App\Http\Controllers\Admin\CollageGalleryController::class, 'gallerylist'])->name('admin.collages.gallerylist');
	Route::get('admin/collages/seminars/all', [App\Http\Controllers\Admin\CollageSeminarController::class, 'seminarslist'])->name('admin.collages.seminarlist');
});