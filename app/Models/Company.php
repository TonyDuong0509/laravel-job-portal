<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'logo',
        'banner',
        'bio',
        'vision',
        'industry_type_id',
        'organization_type_id',
        'team_size_id',
        'establishment_date',
        'website',
        'email',
        'phone',
        'country',
        'state',
        'city',
        'address',
        'map_link',
    ];

    // public function sluggable(): array
    // {
    //     return [
    //         'slug' => [
    //             'source' => 'name'
    //         ]
    //     ];
    // }

    public function industryType(): BelongsTo
    {
        return $this->belongsTo(IndustryType::class, 'industry_type_id', 'id');
    }

    public function organizationType(): BelongsTo
    {
        return $this->belongsTo(OrganizationType::class, 'organization_type_id', 'id');
    }

    public function teamSize(): BelongsTo
    {
        return $this->belongsTo(TeamSize::class, 'team_size_id', 'id');
    }

    public function companyCountry(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country', 'id');
    }

    public function companyState(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state', 'id');
    }

    public function companyCity(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city', 'id');
    }

    public function userPlan(): HasOne
    {
        return $this->hasOne(UserPlan::class, 'company_id', 'id');
    }

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class, 'company_id', 'id');
    }
}
