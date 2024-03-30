<?php

namespace App\Models;

use App\Http\Resources\ProjectResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    const TYPE_CLIENT_PROJECT = 1;
    const TYPE_INTERNAL_PROJECT = 2;

    const STATUS_NOT_STARTED = 0;
    const STATUS_IN_PROGRESS = 1;
    const STATUS_ON_HOLD = 2;
    const STATUS_CANCELLED = 3;
    const STATUS_FINISHED = 4;

    const TYPE_MAPPING = [
        self::TYPE_CLIENT_PROJECT => "Client Project",
        self::TYPE_INTERNAL_PROJECT => "Internal Project"
    ];

    const STATUS_MAPPING = [
        self::STATUS_NOT_STARTED => "Not Started",
        self::STATUS_IN_PROGRESS => "In Progress",
        self::STATUS_ON_HOLD => "On Hold",
        self::STATUS_CANCELLED => "Cancelled",
        self::STATUS_FINISHED => "Finished"
    ];

    protected $fillable = [
        'title',
        'code',
        'description',
        'type',
        'client',
        'total_rate',
        'lead_by',
        'start_date',
        'end_date',
        'created_by',
        'deleted_by',
        'status',
        'created_at',
        'updated_at'
    ];

    public function findProjectById($id) {
        return self::query()->findOrFail($id);
    }

    public function createProject($data) {
        return self::query()->create($data);
    }

    public function getProjects($search = []) {
        $query = self::query();

        if (!empty($search['paginate'])) {
            $result = $query->paginate($search['paginate']);
        } else {
           $result = $query->get();
        }

        return ProjectResource::collection($result);
    }

    public function deleteProject($id) {
       $project = self::findOrFail($id);
       return $project->delete();
    }

    public function leadBy() {
        return $this->belongsTo(User::class, 'lead_by');
    }

    public function clientId() {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function deletedBy() {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
