<?php

namespace App\Http\Resources;
use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Payload;
class UserAccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    
     public $status;
     public $message;
     

     public function __construct($status, $message, $resource)
     {
         parent::__construct($resource);
         $this->status  = $status;
         $this->message = $message;
     }
 
 
    public function toArray($request)
    {
        $payload = new Payload();
        return $payload->toArrayPayload($request, $this->status, $this->message, $this->resource);
        
    }
}
