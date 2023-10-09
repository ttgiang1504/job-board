<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    use HasFactory;

    public static array $experience = ['entry', 'intermediate', 'senior'];
    public static array $category =['IT', 'Finance', 'Sales', 'Maketing'];

    public function employer(): BelongsTo{
        return $this->belongsTo(Employer::class);
    }

    public function jobApplication(): HasMany{
        return $this-> hasMany(JobApplication::class);
    }


    // dùng để xem có user apply công việc hay chưa
    public function hasUserApplied(Authenticatable|User|int $user): bool 
    {   
        //khi nhấn vào show xem chi tiết job thì sẽ có id của job đó
        //ta sẽ dùng ($this->where('id', $this->id)) kiểm tra xem job_id của job ta đang xem có bằng với id mà user đã apply trong database hay không
        // đồng thời cũng thực hiện tìm kiếm  mối quan hệ 'jobApplication' 
        //có user_id trong bảng job_applycation = với user_id người dùng đang xem công việc hay không
        //dùng  exists để  kiểm tra xem có bản ghi nào thỏa mã điều kiện hay không
        // nếu có trả về true, không có trả về false
        return $this->where('id', $this->id)
            ->whereHas('jobApplication',fn($query) => $query->where('user_id', '=', $user->id ?? $user)
            )->exists();
    }

    
    public function scopeFilter(Builder|QueryBuilder $query, array $filters): Builder|QueryBuilder 
    {
        return $query->when($filters['search'] ?? null, function($query, $search){
            $query->where(function($query) use($search){
                $query->where('title', 'like','%'.$search.'%')
                  ->orWhere('description', 'like','%'.$search   .'%')
                  //mối quan hệ lồng nhau nên sử dụng WhereHas
                  ->orWhereHas('employer', function($query) use($search){
                        $query->where('company_name','like','%'.$search.'%');
                  });
            });
        })->when($filters['min_salary'] ?? null, function($query, $min_salary){
            $query->where('salary' ?? null, '>=', $min_salary);
        })->when($filters['max_salary'] ?? null, function($query, $max_salary){
            $query->where('salary', '<=', $max_salary);
        })->when($filters['experience'] ?? null, function($query, $experience){
            $query->where('experience', $experience);
        })->when($filters['category'] ?? null, function($query, $category){
            $query->where('category', $category);
        });
    }
}
