<?php

declare(strict_types=1);

namespace Modules\Cms\Models;

use Illuminate\Database\Eloquent\Builder;
// use Modules\User\Models\Traits\HasTeams;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Tenant\Services\TenantService;
use Z3d0X\FilamentFabricator\Models\Page as ModelsPage;

/**
 * Modules\Cms\Models\Page
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Page> $allChildren
 * @property-read int|null $all_children_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Page> $children
 * @property-read int|null $children_count
 * @property-read Page|null $parent
 * @method static Builder|Page newModelQuery()
 * @method static Builder|Page newQuery()
 * @method static Builder|Page query()
 * @mixin \Eloquent
 */
class Page extends ModelsPage
{
    use HasFactory;

    // use HasTeams;
    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'slug',
        'blocks',
        'layout',
        'parent_id',
        'tenant_name',
    ];

    protected $casts = [
        'blocks' => 'array',
        'parent_id' => 'integer',
    ];

    /**
     * @var string
     */
    protected $connection = 'cms';

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('tenant_name', function (Builder $builder) {
            $builder->where('tenant_name', 'like', TenantService::getName());
        });
    }
}