<?php

namespace PN\Social;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PN\Foundation\Presenters\PresenterTrait;
use PN\Users\User;

class Comment extends Model
{

    protected $table = 'comments';
    public $timestamps = true;

    use SoftDeletes, PresenterTrait;

    protected $dates = ['deleted_at'];
    protected $fillable = array('asset_id', 'user_id', 'body');
    protected $visible = array('asset_id', 'user_id', 'body');

    protected function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user_id = $user->id;
    }

    public function setAsset($asset)
    {
        $this->asset_id = $asset->id;
    }

    public function getAsset()
    {
        return $this->asset;
    }
}
