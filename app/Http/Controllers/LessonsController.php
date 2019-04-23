<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Transformer\LessonTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class LessonsController extends ApiController
{
    protected $lessonTransformer;
    
    public function __construct(LessonTransformer $lessonTransformer)
    {
        $this->lessonTransformer = $lessonTransformer;
        $this->middleware('auth.basic',['only' => ['store','update']]);
    }
    
    public function index()
    {
        
        $lessons =  Lesson::all();
        return $this->response(
            [
                'stats'=>'success',
                'data'=>$this->lessonTransformer->transformCollection($lessons->toArray())
            ]
        );
    }
    
    public function show($id)
    {
        $lesson = Lesson::find($id);
        if (!$lesson) {
            return $this->responseNotFound();   //链式操作，返回$this
        }
        return $this->response(
            [
                'stats'=>'success',
                'lessons'=>$this->lessonTransformer->transform($lesson)
            ],200
        );
    }
    
    public function store(Request $request)
    {
        if (!$request->get('title') or !$request->get('body')){
            return $this->setStatusCode(422)->responseError('validate fails');
        }
    }
    
    
    
}
