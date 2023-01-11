<?php

namespace AbdulsalamEmesh\WhatToDo;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class WhatToDo
{
    private string $base_url = "http://what-to-do-api.test/api";
    private string $version;
    private array $queryParameters = [];

    /**
     * @param string $version
     */
    public function __construct(string $version = 'v1')
    {
        $this->version = $version;
    }

    /**
     * @return \Illuminate\Support\Collection|\Exception
     * @throws \Exception
     */
    public function getTask(): \Illuminate\Support\Collection
    {
        $response = Http::withHeaders(['content-type' => 'application/json', 'accept' => 'application/json'])->get($this->base_url . '/' . $this->version . '/task', $this->queryParameters);

        if ($response->successful()) {
            return $response->collect();
        } else {
            throw new \Exception($response->collect()->get('message'));
        }
    }

    /**
     * @param $identifier string A string , which identifies a specific task
     * @return WhatToDo
     */
    public function identifier(string $identifier): WhatToDo
    {
        $this->queryParameters = Arr::prepend($this->queryParameters, $identifier, 'identifier');
        return $this;
    }

    /**
     * @param string $language
     * @return $this
     */
    public function language(string $language): WhatToDo
    {
        $this->queryParameters = Arr::prepend($this->queryParameters, $language, 'language');
        return $this;
    }

    /**
     * @param string $category
     * @return $this
     */
    public function category(string $category): WhatToDo
    {
        $this->queryParameters = Arr::prepend($this->queryParameters, $category, 'category');
        return $this;
    }

    /**
     * @param int $person
     * @return $this
     * @throws \Exception
     */
    public function person(int $person): WhatToDo
    {
        if ($person < 1 || $person > 10) {
            throw new \Exception('The person count schuld be between 1 and 10');
        }
        $this->queryParameters = Arr::prepend($this->queryParameters, $person, 'person');
        return $this;
    }

    /**
     * @param string $cost
     * @return $this
     * @throws \Exception
     */
    public function cost(string $cost): WhatToDo
    {
        if (!in_array($cost, ['free', '$', '$$', '$$$'])) {
            throw new \Exception('The cost schuld be one of the following: free, $, $$, $$$');
        }
        $this->queryParameters = Arr::prepend($this->queryParameters, $cost, 'cost');
        return $this;
    }

    /**
     * @param array $data
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    public function create(array $data): \Illuminate\Support\Collection
    {
        $response = Http::withHeaders(['content-type' => 'application/json', 'accept' => 'application/json'])->post($this->base_url . '/' . $this->version . '/task/create', $data);

        if ($response->successful()) {
            return $response->collect();
        } else {
            throw new \Exception($response->collect()->get('message'));
        }
    }

}
