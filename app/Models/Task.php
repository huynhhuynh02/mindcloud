<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tasks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['text', 'description', 'project_id', 'created_by'];

    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function tasktype()
    {
        return $this->belongsTo(TaskType::class, 'task_type_id');
    }

    public function taskfiles()
    {
        return $this->belongsToMany(Files::class, 'task_files', 'task_id', 'file_id');
    }

    public function getStatusColor()
    {
        switch ($this->status) {
            case 0:
                return 'bg-primary';
                break;

            case 1:
                return 'bg-success';
                break;

            case 2:
                return 'bg-danger';
                break;
            default:
                # code...
                break;
        }
    }

    public function getStatusName($status)
    {   
        $statuss = ['Open', 'Inprocess', 'Resovled', 'Close'];

        return $statuss[$status];
    }

    public function getTypeColor($name)
    {   
        switch ($name) {
            case 'Task':
                return 'btn btn-primary';
                break;

            case 'Bug':
                return 'btn btn-danger';
                break;

            case 'Request':
                return 'btn btn-info';
                break;

            default:
                return 'btn btn-primary';
                break;
        }
    }

    public function assignees()
    {
        return $this->belongsToMany(User::class, 'task_assignees');
    }
}
