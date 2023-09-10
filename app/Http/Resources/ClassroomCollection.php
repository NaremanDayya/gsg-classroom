<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ClassroomCollection extends ResourceCollection
{
    public static $wrap = 'classrooms';
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'classrooms' => $this->collection->map(function ($classroom) {
        return [
            'id' => $classroom->id,
            'name' => $classroom->name,
            'code' => $classroom->code,
            'cover_image' => $classroom->cover_image_url,
            'meta' => [
                'section' => $classroom->section,
                'room' => $classroom->room,
                'subject' => $classroom->subject,
                'theme' => $classroom->theme,
                'students count' =>$classroom->std ?? 0,
            ],
            'user' => [
                'name' => $classroom->user?->name,
                
            ]
        ];
    }),
];
    }
}
