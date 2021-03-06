<?php

namespace PN\Users;


use PN\Foundation\Presenters\Presenter;

class UserPresenter extends Presenter
{
    public function avatarUrl()
    {
        if(strpos($this->model->avatar, 'http') === 0) {
            return $this->model->avatar;
        }

        if($this->model->avatar == '') {
            $link = 'https://www.gravatar.com/avatar/' . md5($this->model->email) . '?s=128&d=';
            $link .= urlencode('https://parkitectnexus.com/img/avatar-default.png');

            return $link;
        }

        return '/media/avatars/'.$this->model->avatar;
    }

    public function displayName()
    {
        $name = $this->model->username;

        if ($name == '') {
            return $this->model->name;
        }

        return $name;
    }

    public function url()
    {
        return route('users.show', [$this->model->username]);
    }

    public function hasFlair()
    {
        return $this->model->flair != '';
    }

    public function uploadCount()
    {
        $user = $this->model;

        return \Cache::remember(sprintf('users.%s.uploadcount', $this->model->id), rand(10, 30), function() use ($user){
            return $user->assets()->count();
        });
    }

    public function postCount()
    {
        $user = $this->model;

        return \Cache::remember(sprintf('users.%s.postcount', $this->model->id), rand(10, 30), function() use ($user){
            return $user->posts()->count();
        });
    }

    public function likeCount()
    {
        $user = $this->model;

        return \Cache::remember(sprintf('users.%s.likecount', $this->model->id), rand(10, 30), function() use ($user){
            $count = 0;

            foreach($user->getAssets() as $asset) {
                $count += $asset->like_count;
            }

            return $count;
        });
    }

    public function settingsUrl()
    {
        return route('users.settings');
    }

    public function uploadsUrl()
    {
        return route('users.uploads', [$this->model->username]);
    }

    public function downloadsUrl()
    {
        return route('users.downloads', [$this->model->username]);
    }

    public function viewsUrl()
    {
        return route('users.views', [$this->model->username]);
    }

    public function likesUrl()
    {
        return route('users.likes', [$this->model->username]);
    }

    public function registrationDate()
    {
        return date('d F Y', strtotime($this->model->created_at));
    }

    public function hasSteam()
    {
        return $this->model->steam_id != null;
    }

    public function twitterUrl()
    {
        return sprintf('https://twitter.com/%s', $this->model->twitter);
    }

    public function twitchUrl()
    {
        return sprintf('https://twitch.tv/%s', $this->model->twitch);
    }

    public function steamUrl()
    {
        return sprintf('https://steamcommunity.com/profiles/%s', $this->model->steam_id);
    }

    public function paypalUrl()
    {
        return sprintf('https://paypal.me/%s', $this->model->paypal);
    }

    public function bitcoinUrl()
    {
        return sprintf('bitcoin:%s', $this->model->bitcoin);
    }
}
