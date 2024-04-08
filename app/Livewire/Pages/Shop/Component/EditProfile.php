<?php

namespace App\Livewire\Pages\Shop\Component;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class EditProfile extends Component
{
    public User $user;
    use WithFileUploads;

    public $photo;

    public $showingSales = false;

    public function showSales()
    {
        $this->showingSales = true;
    }

    public function showListings()
    {
        $this->showingSales = false;
    }

    protected $rules = [
        'user.username' => 'string|max:255',
        'photo' => 'nullable|image|max:1024', // 1MB Max
    ];

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function save()
    {
        $this->validate();

        if ($this->photo) {
            $path = $this->photo->store('/public/assets/img/profile-photos');
            $this->user->profile_picture = $path;
        }
        $this->user->save();


        return redirect()->to('/profile/' . $this->user->id);
    }

    public function render()
    {
        return view('livewire.pages.shop.component.edit-profile', [
            'showingSales' => $this->showingSales
        ]);
    }
}