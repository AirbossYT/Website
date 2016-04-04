<?php

namespace PN\Assets\Repositories;


use Illuminate\Support\Collection;
use PN\Assets\Asset;
use PN\Assets\Repositories\Criteria\NameCriteria;
use PN\Assets\Repositories\Criteria\NoBuildOffCriteria;
use PN\Assets\Repositories\Criteria\SortCriteria;
use PN\Assets\Repositories\Criteria\StatCriteria;
use PN\Assets\Repositories\Criteria\TypeCriteria;
use PN\Assets\Repositories\Criteria\WithoutTagCriteria;
use PN\Assets\Repositories\Criteria\WithTagCriteria;
use PN\Foundation\Repositories\BaseRepository;

class AssetRepository extends BaseRepository implements AssetRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Asset::class;
    }

    public function mostPopular($count)
    {
        return \Cache::remember('assets.mostpopular', 10, function () use ($count) {
            $assets = app($this->model())->orderBy('hot_score', 'desc')->take($count * 4)->get();

            return $assets->random($count);
        });
    }

    public function newest($count)
    {
        return \Cache::remember('assets.newest', 10, function () use ($count) {
            return app($this->model())->orderBy('created_at', 'desc')->take($count)->get();
        });
    }

    public function filter($type, $name, $stats, $tags, $sort)
    {
        $this->pushCriteria(new NoBuildOffCriteria());
        $this->pushCriteria(new TypeCriteria($type));
        $this->pushCriteria(new NameCriteria($name));

        $tagsOn = (new Collection($tags))->filter(function($val){ return $val == 'on'; })->keys();
        $tagsOff = (new Collection($tags))->filter(function($val){ return $val == 'off'; })->keys();

        $this->pushCriteria(new WithTagCriteria($tagsOn));
        $this->pushCriteria(new WithoutTagCriteria($tagsOff));
        $this->pushCriteria(new StatCriteria($stats));
        $this->pushCriteria(new SortCriteria($sort));

        return $this->paginate();
    }

    /**
     * @param $asset
     * @param $stats
     */
    private function filterBlueprintStats($asset, $stats)
    {
        $asset->where('stats_type', Blueprint::class)->whereIn('stats_id', function ($query) use ($stats) {
            $query = $query->select('id')
                ->from('asset_stats_blueprints');
            foreach ($stats as $stat => $value) {
                if (in_array($stat, ['rating_intensity', 'rating_nausea'])) {
                    $query->where($stat, '<', $value);
                } else {
                    if ($value > 0) {
                        $query->where($stat, '>', $value);
                    }
                }
            }
        });
    }
}
