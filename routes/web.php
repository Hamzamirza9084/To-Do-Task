<?php

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// 

Route::get('/',function(){
    return redirect()->route('tasks.index');
});

Route::view('/tasks/create','create')
->name('task.create');

Route::get('/tasks', function (){
    return view('index',[
        'tasks' => Task::latest()->paginate()
    ]);
})->name('tasks.index');

Route::get('/tasks/{task}/edit',function(Task $task){
        return view('edit',[
            'task' => $task
        ]);
})->name('tasks.edit');


Route::get('/tasks/{task}',function( Task $task){
        return view('show',[
            'task' => $task
        ]);
})->name('tasks.show');

Route::post('/tasks',function(TaskRequest $request){
  
    // $data=$request->validated();
     
    // $task= new Task;
    // $task->title=$data['title'];
    // $task->description=$data['description'];
    // $task->long_description=$data['long_description'];
    // $task->save();

    $task= Task::create($request->validated());

    return redirect()->route('tasks.show',['task'=>$task->id])
    ->with('success',"task was maked");

})->name('tasks.store');

Route::put('/tasks/{task}',function(Task $task,TaskRequest $request){
   
     
  
    // $task->title=$data['title'];
    // $task->description=$data['description'];
    // $task->long_description=$data['long_description'];
    
    $task->update($request->validated());

    return redirect()->route('tasks.show',['task'=>$task->id])
    ->with('success',"task was updated");

})->name('tasks.update');

Route::delete('/tasks/{task}',function(Task $task){
    $task->delete();

    return redirect()->route('tasks.index')
    ->with('success','deleted');
})->name('tasks.destory');

Route::put('/tasks/{task}/toggle',function(Task $task){

    $task->togglecompleted();

    return redirect()->back()->with('success','Task Updated');

})->name('tasks.toggle');

Route::get('/migrate', function () {
    Artisan::call('migrate');
    return 'Migration complete';
});

use Illuminate\Support\Facades\Schema;

Route::get('/check-tasks', function () {
    return Schema::hasTable('tasks') ? 'Table exists' : 'No tasks table';
});


// Route::get('/hello',function(){
//     return 'bot';
// });

// Route::get('/g/{name}',function($name){
//     return 'hello ' . $name .'!';
// });

// Route::get('/hallo',function(){
//     return  redirect('/hello');
// });

// Route::fallback(function(){
//     return '404';
// });