<?php

namespace AbdulsalamEmesh\WhatToDo\Tests;

use AbdulsalamEmesh\WhatToDo\Facades\WhatToDo;
use Illuminate\Support\Collection;
use Orchestra\Testbench\TestCase;

class WhatToDoTest extends TestCase
{

    /** @test */
    public function it_returns_a_task_as_a_collection()
    {
        $task = WhatToDo::getTask();
        $this->assertInstanceOf(Collection::class, $task);
    }

    /** @test */
    public function it_returns_all_keys()
    {
        $task = WhatToDo::getTask();
        foreach (['task', 'identifier', 'category', 'person', 'cost', 'links'] as $key) {
            $this->assertArrayHasKey($key, $task);
        }
    }

    /** @test */
    public function it_checks_task_and_links_keys_values_are_an_array()
    {
        $task = WhatToDo::getTask();
        $this->assertIsArray($task['task']);
        $this->assertIsArray($task['links']);
    }

    /** @test */
    public function it_asserts_task_and_links_values_has_all_supported_languages_keys()
    {
        $languagesKeys = ['en-US', 'de', 'es', 'fr', 'it', 'tr', 'uk',];
        $task = WhatToDo::getTask();

        foreach ($languagesKeys as $languagesKey) {
            $this->assertArrayHasKey($languagesKey, $task['task']);
            $this->assertArrayHasKey($languagesKey, $task['links']);
        }
    }

    /** @test */
    public function it_returns_a_task_in_the_category()
    {
        foreach (['staying busy', 'resting', 'social', 'learn', 'charity', 'cook', 'music', 'DIY', 'fun'] as $category) {
            $task3 = WhatToDo::category($category)->getTask();
            $this->assertEquals($category, $task3['category']);
        }
    }

    /** @test */
    public function it_returns_a_task_in_the_provided_person_count()
    {
        foreach ([1, 2, 3] as $person) {
            $task = WhatToDo::person($person)->getTask();
            $this->assertEquals($person, $task['person']);
        }
    }

    /** @test */
    public function it_returns_a_task_in_the_provided_cost()
    {
        foreach (['free', '$', '$$', '$$$'] as $cost) {
            $task = WhatToDo::cost($cost)->getTask();
            $this->assertEquals($cost, $task['cost']);
        }
    }

    /** @test */
    public function it_return_the_same_task_for_the_provided_identifier()
    {
        $task = WhatToDo::getTask();
        $task2 = WhatToDo::identifier($task['identifier'])->getTask();
        $this->assertEquals($task2, $task);
    }

    /** @test */
    public function it_return_the_same_task_in_the_language_of_the_provided_language()
    {
        $task = WhatToDo::getTask();
        $task1 = WhatToDo::identifier($task['identifier'])->language('en-US')->getTask();
        $this->assertEquals($task1['task'], $task['task']['en-US']);
        $this->assertEquals($task1['links'], $task['links']['en-US']);
    }

    /** @test */
    public function it_creates_a_new_task_and_return_the_identifier()
    {
        $data = [
            'language' => 'en-US',
            'task'     => 'play football',
            'category' => 'fun',
            'person'   => 4,
            'cost'     => '$',
            'links'    => ['en-US' => 'https://google.com']
        ];
        $task = WhatToDo::create($data);

        $this->assertEquals($task['task'][$data['language']], $data['task']);
        $this->assertEquals($task['category'], $data['category']);
        $this->assertEquals($task['person'], $data['person']);
        $this->assertEquals($task['cost'], $data['cost']);
        foreach ($data['links'] as $key => $link) {
            $this->assertEquals($data['links'][$key], $link);
        }
    }

    /** @test */
    public function it_throws_an_exception_if_data_is_not_valid()
    {
        $this->expectException(\Exception::class);
        $data = [
            'task'     => 'play football',
            'category' => 'fun',
            'person'   => 4,
            'cost'     => '$',
            'links'    => ['en-US' => 'https://google.com']
        ];
        WhatToDo::create($data);
    }


}