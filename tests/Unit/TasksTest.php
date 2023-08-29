<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class TasksTest extends TestCase
{

    protected $api_token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNWI4MTQ2ZjBhYTQ0MmNiYmY2MTcxNGEwYzRjYzRiOWZlZGY2YjU1YWExMDI5MGExYWFhZTI4YmZkYjA2ZDFlZDhlMzMwNzZkNzkxZGMyNjEiLCJpYXQiOjE2OTMxNzIzNTksIm5iZiI6MTY5MzE3MjM1OSwiZXhwIjoxNzI0Nzk0NzU5LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.d5GfoIQymHs9_MnzSyeIHPQhSwhV2eEevXiN9BtW0bRSJe-FJIB5xJlo_CMtrtIi-f6Hw6a3HOjhNSuzRKYkq93EgdsxHbjAMzRgSoycT-wh0SIija2Sxzijkh-5wbd_I_zFrCbq5lpDm7cbjXh1W6YsqoAYLzYKY2r02dkruw0uuCfHgnA8ckNh-2Svzx_jFCcbykNKuRCeiAxJsYIkQNS09GohSmrhfYopU6-alW-pE5lTbwJ04nMuuhr621knLaWYgyXh-2FkOuuy__gZPkA_2raKa874UpufnB9tKy64aWeZvJWDBgGVd-kkjKi4t85AdjO99YwspAmL2j-B2qD1xYaaZ6Rg0eX0eosYugqSFykCKPi02c5rour6eZs8GyT9ycVK36DtA_mQ5ZJLTuaEdZc4LmK7srFTHNcK9xvtcsB9TyPq6WXOzWvpuXQMdYBZjmTVJLnwKlWjTsP4CkjAHxu4svKUxvdatRYkheolJUspzSpOcv9rShaVz7C9wHKfzugv10py24mQtpAn9M93r48y4Y4HTrySqSg3evKGMHLOZjc6hn3yEnXh0JS1OBblZZ_RBerJFkWLsewYRzEl7D1kC8_Nlpo5YFLtuiZPyyLHzD-BsxUzI9QYwL0eo2EajVz80YLBIJ0OKuJZYsiyykea_9326IyxudbsrsA';
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }


    public function testGetTask()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->api_token,
        ])->get('/api/task');
 
        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

    public function testCreateTask()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->api_token,
        ])->post('/api/task', [
            'title' => 'nor test unit',
            'description' => 'nor test unit description',
            'due_date' => '2023-08-29 20:31:58',
        ]);
 
        $response
            ->assertStatus(201)
            ->assertJson([
                'success' => true,
            ]);
    }

    public function testUpdateTask()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->api_token,
        ])->post('/api/task/1', [
            'title' => 'nor test unit update',
            'description' => 'nor test unit update description',
            'due_date' => '2023-08-29 20:31:58',
            '_method' => 'put' // or patch,
        ]);
 
        $response->assertStatus(204);
    }

    public function testDeleteTask()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->api_token,
        ])->delete('/api/task/1');
 
        $response->assertStatus(204);
    }
}
