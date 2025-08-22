<?php

namespace App\Livewire;

use Livewire\Component;

class ShowUser extends Component
{
    public $namaPengguna = 'Andi Budi';
    public $emailPengguna = 'andi.budi@example.com';

    public function render()
    {
        return view('livewire.show-user');
    }
}
