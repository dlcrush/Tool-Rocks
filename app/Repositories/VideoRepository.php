<?php

namespace App\Repositories;
use App\Repositories\Contracts\VideoRepository as VideoRepositoryInterface;
use App\Library\Http\Contracts\Http;
use App\Library\Http\Contracts\UrlBuilder;

class VideoRepository implements VideoRepositoryInterface {

    protected $http;
    protected $urlBuilder;

    public function __construct(Http $http, UrlBuilder $urlBuilder) {
        $this->http = $http;
        $this->urlBuilder = $urlBuilder;
        $this->urlBuilder->setBaseUrl(url('/') . '/api/v1/');
        $apiKey = \Config::get('api.api_key');
        $this->urlBuilder->addParam('key', $apiKey);
    }

    public function getVideo($id) {
        $url = $this->urlBuilder
            ->path('videos/'.$id)
            ->params([])
            ->build();

        return json_decode($this->http->get($url), true);
    }

    public function getVideos($options=array()) {
        $params = [];

        if (array_has($options, 'page')) {
            $params['page'] = array_get($options, 'page');
        }
        if (array_has($options, 'tags')) {
            $params['tags'] = array_get($options, 'tags');
        }
        if (array_has($options, 'year')) {
            $params['year'] = array_get($options, 'year');
        }
        if (array_has($options, 'type')) {
            $params['type'] = array_get($options, 'type');
        }
        if (array_has($options, 'orderBy')) {
            $params['orderBy'] = array_get($options, 'orderBy');
        }

        $url = $this->urlBuilder
            ->path('videos')
            ->params($params)
            ->build();

        return json_decode($this->http->get($url), true);
    }

    public function searchVideos($options=array()) {
        $params = [];

        if (array_has($options, 'text')) {
            $params['text'] = array_get($options, 'text');
        }
        if (array_has($options, 'page')) {
            $params['page'] = array_get($options, 'page');
        }

        if (array_has($options, 'tags')) {
            $params['tags'] = array_get($options, 'tags');
        }

        if (array_has($options, 'year')) {
            $params['year'] = array_get($options, 'year');
        }

        if (array_has($options, 'type')) {
            $params['type'] = array_get($options, 'type');
        }

        if (array_has($options, 'songs')) {
            $params['songs'] = array_get($options, 'songs');
        }

        $url = $this->urlBuilder
            ->path('videos/search')
            ->params($params)
            ->build();

        return json_decode($this->http->get($url), true);
    }

    public function getRandomVideo() {
        $url = $this->urlBuilder
            ->path('videos/random')
            ->build();

        return json_decode($this->http->get($url, ['cache' => false]), true);
    }

    public function getDailyFix() {
        $url = $this->urlBuilder
            ->path('dailyfix')
            ->build();

        return json_decode($this->http->get($url), true);
    }

}
