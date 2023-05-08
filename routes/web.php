Route::middleware('role:admin')->prefix('admin')->namespace('Admin')->group(function () {
	Route::get('/menu', [App\Http\Controllers\Admin\MenuController::class,'index']);
    Route::post('/menu/addcustommenu',[App\Http\Controllers\Admin\MenuController::class,'addcustommenu'])->name('haddcustommenu');
    Route::post('/menu/deleteitemmenu',[App\Http\Controllers\Admin\MenuController::class,'deleteitemmenu'])->name('hdeleteitemmenu');
    Route::post('/menu/deletemenug',[App\Http\Controllers\Admin\MenuController::class,'deletemenug'])->name('hdeletemenug');
    Route::post('/menu/createnewmenu',[App\Http\Controllers\Admin\MenuController::class,'createnewmenu'])->name('hcreatenewmenu');
    Route::post('/menu/generatemenucontrol',[App\Http\Controllers\Admin\MenuController::class,'generatemenucontrol'])->name('hgeneratemenucontrol');
    Route::post('/menu/updateitem', [App\Http\Controllers\Admin\MenuController::class,'updateitem'])->name('hupdateitem');
});