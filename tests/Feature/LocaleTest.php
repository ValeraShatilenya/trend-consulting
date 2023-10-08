<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LocaleTest extends TestCase
{
    use RefreshDatabase;

    public function test_change_locale_to_available(): void
    {
        foreach (['en', 'ru'] as $locale) {
            $this->from(route('locations.index'))
                ->get(route('locale', compact('locale')))
                ->assertSessionDoesntHaveErrors()
                ->assertRedirect(route('locations.index'))
                ->assertSessionHas('locale', $locale);
        }
    }

    public function test_change_locale_to_not_available(): void
    {
        $this->from(route('locations.index'))
            ->get(route('locale', ['locale' => 'de']))
            ->assertBadRequest();
    }
}
