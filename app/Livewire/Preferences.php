<?php

namespace App\Livewire;

use Livewire\Component;

class Preferences extends Component
{
    public $preferences = [
        'casual' => null,
        'formal' => null,
        'sports' => null,
    ];


    public $user_preferences = [];


    public function updatedPreferences($value, $key)
    {
        if ($value === true) {
            // Add the key to user_preferences if not already present
            if (!in_array($key, $this->user_preferences)) {
                $this->user_preferences[] = $key;
            }
        } elseif ($value === false) {
            // Remove the key from user_preferences if it is present
            if (($index = array_search($key, $this->user_preferences)) !== false) {
                unset($this->user_preferences[$index]);
            }
        }
    }


    public function savePreferences()
    {
        $this->validator();
        session(['user_preferences' => $this->user_preferences]);
        $this->redirect('/onboarding/styles');
    }

    public function validator()
    {
        // Add a custom validation rule to ensure at least one preference is true
        validator()->make(
            ['preferences' => $this->preferences],
            ['preferences' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!in_array(true, $value, true)) {
                        $fail('At least one preference must be selected.');
                    }
                },
            ]]
        )->validate();
    }

    public function mount()
    {
        if (session()->has('user_preferences')) {
            $this->user_preferences = session('user_preferences');

            // Reset preferences
            $this->preferences = [
                'casual' => false,
                'formal' => false,
                'sports' => false,
            ];

            // Update preferences state based on the session data
            foreach ($this->user_preferences as $preference) {
                if (isset($this->preferences[$preference])) {
                    $this->preferences[$preference] = true;
                }
            }
        }
    }



    public function render()
    {
        if (!auth()->check()) {
            redirect('/login');
        }

        return view('livewire.pages.preferences');
    }
}
