<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Job extends Model
{
   use HasFactory;
   // use Searchable;
   protected $fillable = [
      'job_name',
      'job_category_id',
      'job_type_id',
      'vacancy',
      'salary',
      'location',
      'description',
      'benefit',
      'experience_id',
      'responsibility',
      'qualification',
      'keyword',
      'company_name',
      'company_location',
      'company_website',
      'user_id',
      'status',
   ];

   public function jobType()
   {
      return $this->belongsTo(JobType::class);
   }
   public function jobCategory()
   {
      return $this->belongsTo(JobCategory::class);
   }
  
}
