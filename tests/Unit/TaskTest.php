<?php

namespace Tests\Unit;

use Tests\TestCase;
use Exception;
use App\Models\Item;
use Illuminate\Support\Carbon;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class TaskTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_user_can_get_all_items(){

        $this->withoutExceptionHandling();
        $response=$this->json('GET','api/items',['Accept'=>'application/json']);
        $response->assertStatus(200);
    }

    public function test_user_can_add_new_task()
    {
        $task = [
            "item"=>[
                "name" => "Homework"
            ]
            ];

        $this->withoutExceptionHandling();
        $this->json('POST','api/item/store',$task,['Accept'=>'application/json'])->assertStatus(201);
    }

    public function test_user_can_set_task_as_completed()
    {
        $this->withoutExceptionHandling();
        $task = [
            "item"=>[
                "name" => "Homework"
            ]
            ];

        
        $response=$this->post('api/item/store',$task);

        $task = [
            "item"=>[
                "name" => "Homework" ,
                "completed" => true
            ]
            ];
          
            $this->json('PUT','api/item/' .$response["id"],$task,['Accept'=>'application/json'])->assertStatus(201);
    }

    public function test_user_can_delete_task()
    {
        $this->withoutExceptionHandling();
        $task = [
            "item"=>[
                "name" => "Homework"
            ]
            ];

        
        $response=$this->post('api/item/store',$task);
        $response->dump();

          
            $this->json('Delete','api/item/' .$response["id"],$task,['Accept'=>'application/json'])->assertStatus(204);
    }


}
