<?php

namespace App\Http\Resources;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'code' => $this->code,
            'description' => $this->description,
            'type' => Project::TYPE_MAPPING[$this->type],
            'client_id' => $this->clientId?->name,
            'total_rate' => $this->total_rate,
            'lead_by' => $this->leadBy?->name,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'created_by' => $this->createdBy?->name,
            'deleted_by' => $this->deletedBy?->name,
            'status' => Project::STATUS_MAPPING[$this->status],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
