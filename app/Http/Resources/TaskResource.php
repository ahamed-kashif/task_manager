<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'deadline' => date('F j, Y, g:i a', strtotime("{$this->deadline}")),
            'created_at' => date('F j, Y, g:i a', strtotime("{$this->created_at}")),
            'updated_at' => date('F j, Y, g:i a', strtotime("{$this->updated_at}")),
            'edit_url' => route('tasks.edit',$this->slug),
            'delete_url' => route('tasks.delete',$this->slug)
        ];
    }
}
