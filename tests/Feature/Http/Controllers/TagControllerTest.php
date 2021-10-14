<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Tag;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store()
    {
        $this->withoutExceptionHandling();

        $this->post('tags', [
            'name' => 'PHP'
        ])
        ->assertRedirect('/');

        $this->assertDatabaseHas('tags', ['name' => 'PHP']);
    }

    public function test_destroy()
    {
        $this->withoutExceptionHandling();
        $tag = Tag::factory()->create();
        $this->delete("tags/$tag->id")
        ->assertRedirect('/');
        $this->assertDatabaseMissing('tags', ['name' => $tag->name]);
    }

    /**
     * @test
     * @dataProvider nameInputValidation
     */
    public function test_validate_name_field_has_a_value_when_create_a_new_tag($formInput, $formInputValue)
    {
        $response = $this->post( route('tags.store', [
            $formInput => $formInputValue
        ]));

        $response->assertSessionHasErrors($formInput);
    }

    public function nameInputValidation()
    {
        return [
            'Name is required' => ['name', ''],
            'Name is string' => ['name', 123],
        ];
    }
}
