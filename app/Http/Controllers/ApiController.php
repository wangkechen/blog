<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends Controller
{
    protected $statusCode = 200;
    
    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
    
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }
    
    
    public function responseNotFound($message = 'not found')
    {
        return $this->setStatusCode(404)->responseError($message);
    }
    
    public function responseError($message)
    {
        return $this->response([
            'status' => 'failed',
            'errors' => [
                'statusCode' => $this->getStatusCode(),
                'message' => $message
            ]
        ]);
    }
    
    public function response($data)
    {
        return Response::json($data,$this->getStatusCode());
    }
}
