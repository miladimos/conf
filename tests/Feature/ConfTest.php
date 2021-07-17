<?php

namespace Miladimos\Conf\Tests\Feature;

use Illuminate\Http\Response;

use Miladimos\Conf\Tests\TestCase;

class ConfTest extends TestCase
{

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
        $this->assertMatchesRegularExpression('/^\[\{"id":1,"key":"key","value":"value"\}\,\{"id":\d+,"key":"ping","value":"pong"\}\]$/',$response->content());
    }
    /**
     * test conf helper
     *
     * @return void
     */
    public function test_conf_helper()
    {
        $this->postJson($this->base_path.'/store', [
            'key' => 'ping.key',
            'value' => 'pong'
        ])->assertStatus(Response::HTTP_OK);
        $this->assertSame('pong',conf('ping.key'));
    }

}
