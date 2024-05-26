<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['filename', 'filepath', 'mime_type', 'folder_id'];

    public function folder()
    {
        return $this->belongsTo(Category::class, 'folder_id');
    }

    public function getFolderNameAttribute(){
        return isset($this->folder->name) ? $this->folder->name : "";
    }

    public function getCreatedDateAttribute(){
        return date('Y-m-d', strtotime($this->created_at));
    }
}
