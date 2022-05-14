<?php

namespace Tests\Feature;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\User;
use Tests\TestCase;

class TestTest extends TestCase
{
    /** @var User */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /** @test */
    public function create_test()
    {
        $this->actingAs($this->user)
            ->postJson(route('tests.store'), [
                'name' => 'Lorem',
                'description' => 'Loremorem',
            ])
            ->assertSuccessful()
            ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

        $this->assertDatabaseHas('tests', [
            'name' => 'Lorem',
            'description' => 'Loremorem',

        ]);
    }

    /** @test */
    public function update_test()
    {
        $test = Test::factory()->create();

        $this->actingAs($this->user)
            ->putJson(route('tests.update', $test->id), [
                'name' => 'Updated test',
                'description' => 'Loremoremo',

            ])
            ->assertSuccessful()
            ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

        $this->assertDatabaseHas('tests', [
            'id' => $test->id,
            'name' => 'Updated test',
            'description' => 'Loremoremo',

        ]);
    }

    /** @test */
    public function show_test()
    {
        $test = Test::factory()->create();

        $this->actingAs($this->user)
            ->getJson(route('tests.show', $test->id))
            ->assertSuccessful()
            ->assertJson([
                'data' => [
                    'name' => $test->name,
                    'description' => $test->description,
                ],
            ]);
    }

    /** @test */
    public function list_test()
    {
        $tests = Test::factory()->count(2)->create()->map(function ($test) {
            return $test->only(['id', 'name', 'description']);
        });

        $this->actingAs($this->user)
            ->getJson(route('tests.index'))
            ->assertSuccessful()
            ->assertJson([
                'data' => $tests->toArray(),
            ])
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'description'],
                ],
                'links',
                'meta',
            ]);
    }

    /** @test */
    public function delete_test()
    {
        $test = Test::factory()->create([
            'name' => 'Test for delete',
            'description' => 'Test for delete',
        ]);

        $this->actingAs($this->user)
            ->deleteJson(route('tests.update', $test->id))
            ->assertSuccessful()
            ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

        $this->assertDatabaseMissing('tests', [
            'id' => $test->id,
            'name' => 'Test for delete',
            'description' => 'Test for delete',
        ]);
    }
}
