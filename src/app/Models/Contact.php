<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tell',
        'address',
        'building',
        'detail'
    ];

    // リレーション
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // 検索
    public function scopeUserSearch($query, $input)
    {
        if(!empty($input)){
            $query->where(function ($q) use ($input){
                $q->where('first_name', 'LIKE', "%{$input}%")
                ->orWhere('last_name', 'LIKE', "%{$input}%")
                ->orWhereRaw("CONCAT(last_name, ' ', first_name) = ?", [$input])
                ->orWhere('email', 'LIKE', "%{$input}%")
                ->orWhere('email', $input);
            });
        }
    }

    public function scopeGenderSearch($query, $gender)
    {
        // 完全一致
        if (!empty($gender) && $gender !== '全て') {
            $query->where('gender', $gender);
        }
    }

    public function scopeCategorySearch($query, $category_id)
    {
        // 完全一致
        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }
    }

    public function scopeDateSearch($query, $date)
    {
        // 完全一致 (日付のみ)
        if (!empty($date)) {
            $query->whereDate('updated_at', $date);
        }
    }
}
