<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(JobCategory::class, 'job_category_id', 'id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function jobType(): BelongsTo
    {
        return $this->belongsTo(JobType::class, 'job_type_id', 'id');
    }

    public function jobRole(): BelongsTo
    {
        return $this->belongsTo(JobRole::class, 'job_role_id', 'id');
    }

    public function salaryType(): BelongsTo
    {
        return $this->belongsTo(SalaryType::class, 'salary_type_id', 'id');
    }

    public function jobExperience(): BelongsTo
    {
        return $this->belongsTo(JobExperience::class, 'job_experience_id', 'id');
    }

    public function jobEducation(): BelongsTo
    {
        return $this->belongsTo(Education::class, 'education_id', 'id');
    }

    public function tags(): HasMany
    {
        return $this->hasMany(JobTag::class, 'job_id', 'id');
    }

    public function benefits(): HasMany
    {
        return $this->hasMany(JobBenefits::class, 'job_id', 'id');
    }

    public function skills(): HasMany
    {
        return $this->hasMany(JobSkills::class, 'job_id', 'id');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(AppliedJob::class, 'job_id', 'id');
    }
}
