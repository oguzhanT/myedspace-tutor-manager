<?php

namespace App\Livewire;

use App\Enums\Subject;
use App\Models\Tutor;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class TutorSearch extends Component
{
    public string $searchTerm = '';

    public array $selectedSubjects = [];

    public int $minRate = 0;

    public int $maxRate = 200;

    public array $subjects = [];

    public function mount(): void
    {
        // Initialize subjects or fetch from database
        $this->subjects = Subject::toSelectArray();
    }

    public function render(): View
    {

        $tutors = Tutor::query()
            ->when($this->searchTerm, function ($query) {
                $query->where('name', 'like', '%'.$this->searchTerm.'%')
                    ->orWhere('email', 'like', '%'.$this->searchTerm.'%');
            })
            ->when($this->selectedSubjects, function ($query) {
                foreach ($this->selectedSubjects as $subject) {
                    $query->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(subjects, '$')) LIKE ?", ['%'.$subject.'%']);
                }

            })
            ->whereBetween('hourly_rate', [$this->minRate, $this->maxRate])
            ->get();

        return view('livewire.tutor-search', [
            'tutors' => $tutors,
            'subjects' => $this->subjects,
        ]);
    }

    public function search(): void
    {
        $this->render();
    }
}
