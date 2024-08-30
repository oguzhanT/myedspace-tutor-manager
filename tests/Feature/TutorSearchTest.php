<?php

namespace Tests\Feature\Livewire;

use App\Livewire\TutorSearch;
use App\Models\Tutor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TutorSearchTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function test_search_by_name()
    {
        Tutor::factory()->create(['name' => 'tutor 1']);

        Livewire::test(TutorSearch::class)
            ->set('searchTerm', 'tutor')
            ->assertSee('tutor 1');
    }

    #[Test]
    public function it_filters_tutors_by_selected_subjects()
    {
        Tutor::factory()->create(['subjects' => json_encode('Math,History')]);
        Tutor::factory()->create(['subjects' => json_encode('English')]);

        Livewire::test(TutorSearch::class)
            ->set('selectedSubjects', ['History'])
            ->call('search')
            ->assertSee('Math,History');
    }

    #[Test]
    public function test_filter_by_hourly_rate()
    {
        $tutor = Tutor::factory()->create(['hourly_rate' => 100]);

        Livewire::test(TutorSearch::class)
            ->set('minRate', 50)
            ->set('maxRate', 150)
            ->assertSee($tutor->name);
    }
}
