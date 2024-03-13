<?php

namespace App\Livewire;

use App\Models\Onboarding;
use Livewire\Component;

class Styles extends Component
{
    public $styles = [
        'casual' => null,
        'formal' => null,
        'sports' => null,
    ];
    


    public $user_styles = [];


    public function updatedStyles($value, $key)
    {
        if ($value === true) {
            // Add the key to user_styles if not already present
            if (!in_array($key, $this->user_styles)) {
                $this->user_styles[] = $key;
            }
        } elseif ($value === false) {
            // Remove the key from user_styles if it is present
            if (($index = array_search($key, $this->user_styles)) !== false) {
                unset($this->user_styles[$index]);
            }
        }
    }


    public function saveStylesAndPreferences()
    {
        $this->validator();

        $preferences = session('user_preferences', []); // Get preferences from session
        $styles = $this->user_styles; // Get styles from the component state

        // Define logic for creating a new record or updating an existing one.
        $onboarding = new Onboarding();
        $onboarding->preferences = json_encode($preferences);
        $onboarding->styles = json_encode($styles);
        $onboarding->save();

        // Optionally clear the session variables
        session()->forget(['user_preferences', 'user_styles']);
        session()->flash('message', 'Preferences updated successfully!');
        // Redirect or perform another action
        $this->redirect('/');
    }

    public function validator()
    {
        // Add a custom validation rule to ensure at least one preference is true
        validator()->make(
            ['styles' => $this->styles],
            ['styles' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!in_array(true, $value, true)) {
                        $fail('At least one style must be selected.');
                    }
                },
            ]]
        )->validate();
    }


    public function render()
    {

        return view('livewire.pages.styles');
    }
}
