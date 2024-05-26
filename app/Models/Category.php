<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'parent_id'];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function media(){
        return $this->hasMany(Media::class, 'folder_id');
    }

    public function getCreatedDateAttribute(){
        return date('Y-m-d', strtotime($this->created_at));
    }

    public static function getBreadCrumbs($folder, $breadCrumbsArray = []){
        $breadCrumbsArray[$folder->id] = strtolower($folder->name);

        if(!empty($folder->parent)){
            $breadCrumbsArray = self::getBreadCrumbs($folder->parent, $breadCrumbsArray);
        }
        return $breadCrumbsArray;
    }
}
