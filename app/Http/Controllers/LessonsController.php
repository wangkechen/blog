<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Transformer\LessonTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class LessonsController extends Controller
{
    protected $lessonTransformer;
    
    public function __construct(LessonTransformer $lessonTransformer)
    {
        $this->lessonTransformer = $lessonTransformer;
    }
    
    public function index()
    {
        
        $lessons =  Lesson::all();
        return Response::json(
            [
                'stats'=>'success',
                'code'=>200,
                'lessons'=>$this->lessonTransformer->transformCollection($lessons->toArray())
            ]
        );
    }
    
    public function show($id)
    {
        $lesson = Lesson::findOrFail($id);
        return Response::json(
            [
                'stats'=>'success',
                'code'=>200,
                'lessons'=>$this->lessonTransformer->transform($lesson)
            ]
        );
    }
    
}
