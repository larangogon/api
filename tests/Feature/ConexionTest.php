<?php

namespace Tests\Feature;

use App\Constants\Orders;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConexionTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex(): void
    {
        $response = $this->get(route('orders.index'));

        $response
            ->assertStatus(200)
            ->assertViewIs('main.index');
    }

    public function testShow(): void
    {
        $this->order = Order::create([
            'id'          => 2,
            'status'      => Orders::PENDING,
            'description' => 'Test order create',
            'reference'   => '122334',
            'amount'      => '12345',
        ]);

        $response = $this->get(route('orders.show', $this->order->id));

        $response
            ->assertStatus(200)
            ->assertViewIs('main.show');
    }

    public function testStore(): void
    {
        $response = $this->post(route('orders.store'), [
            'status'      => Orders::PENDING,
            'description' => 'Test order create',
            'reference'   => '122334',
            'amount'      => '12345',
            ]);

        $response
            ->assertStatus(302);

        $this->assertDatabaseHas('orders', [
            'status' => 'PENDING',
        ]);
    }

    public function testUpdate()
    {
        $this->withoutExceptionHandling();

        $this->order = Order::create([
            'status'      => Orders::PENDING,
            'description' => 'Test order update',
            'reference'   => '122334',
            'amount'      => '12345',
            'processUrl'  => "https://test.placetopay.com/redirection/session/429524/47a34d65abeee316e36f882d3757a355",
            'requestId'   => '429524',
        ]);


        $response = $this->put(route('orders.update', $this->order->id), [
                'status'  => Orders::APPROVED,
            ]);

        $response
            ->assertStatus(302);

        $this->assertDatabaseHas('orders', [
            'id'       => $this->order->id,
            'status'   => 'APPROVED',
        ]);
    }

}
