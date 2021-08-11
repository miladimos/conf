<?php

namespace Miladimos\Conf\Tests\Feature;

use Illuminate\Http\Response;

use Miladimos\Conf\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class ConfTest extends TestCase
{
    use WithFaker;
    /**
     * test show all configs
     *
     * @return void
     */
    public function test_show_all_app_config()
    {
        $response = $this->get($this->base_path.'/all');
        $response->assertStatus(Response::HTTP_OK);
    }
    /**
     * test store config
     *
     * @return void
     */
    public function test_store_config()
    {
        $this->postJson($this->base_path.'/store', [
            'key' => 'ping',
            'value' => 'pong'
        ])->assertStatus(Response::HTTP_OK);
        $response = $this->get($this->base_path.'/all')->assertStatus(Response::HTTP_OK);
        $this->assertMatchesRegularExpression('/^\{\"key":{"id":1,"key":"key","value":"value"\}\,"ping":\{"id":\d+,"key":"ping","value":"pong"\}\}$/',$response->content());
    }
    /**
     * test conf helper
     *
     * @return void
     */
    public function test_conf_helper()
    {
        $this->postJson($this->base_path.'/store', [
            'key' => $key = $this->faker->word,
            'value' => $value = $this->faker->word
        ])->assertStatus(Response::HTTP_OK);
        $this->assertSame($value,conf($key));
    }

    /**
     * test update config
     * @return  void
     */
    public function test_update_config()
    {
        $this->postJson($this->base_path.'/store', [
            'key' => $key = $this->faker->word,
            'value' => $value = $this->faker->word
        ])->assertStatus(Response::HTTP_OK);
        $configs = $this->get($this->base_path.'/all');
        $this->postJson($this->base_path.'/update/'.$configs[$key]['id'], [
            'key' => $key,
            'value' => $new_value = $this->faker->word
        ])->assertStatus(Response::HTTP_OK);
        $this->assertSame($new_value,conf($key));
    }
    /**
     * test insert duplicate key config
     * @return  void
     */
    public function test_insert_duplicate_key_config()
    {
        $this->postJson($this->base_path.'/store', [
            'key' => $key = $this->faker->word,
            'value' => $value = $this->faker->word
        ])->assertStatus(Response::HTTP_OK);
        $configs = $this->get($this->base_path.'/all');
        $this->assertSame($value,conf($key));
        $this->postJson($this->base_path.'/store', [
            'key' => $key,
            'value' => $new_value = $this->faker->word
        ])->assertStatus(Response::HTTP_OK);
        $this->assertNotSame($new_value,conf($key));
        $this->assertSame($value,conf($key));
    }
}
