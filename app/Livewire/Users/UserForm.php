<?php

namespace App\Livewire\Users;

use App\Domains\User\Models\User;
use App\Domains\Role\Models\Role;
use App\Domains\UserMangement\Position\Models\Position;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UserForm extends Component
{
    public $userId;
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $is_active = true;
    public $selectedRoles = [];
    public $position_id = null; // ⬅️ tambah ini
    public $showModal = false;
    public $isEditing = false;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->userId),
            ],
            'password' => $this->isEditing ? 'nullable|min:8|confirmed' : 'required|min:8|confirmed',
            'is_active' => 'boolean',
            'selectedRoles' => 'array',
            'position_id' => 'nullable|exists:positions,id', // ⬅️ validasi posisi
        ];
    }

    public function mount($userId = null)
    {
        if ($userId) {
            $this->loadUser($userId);
        }
    }

    public function loadUser($userId)
    {
        $user = User::with(['roles', 'position'])->findOrFail($userId);

        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->is_active = $user->is_active;
        $this->selectedRoles = $user->roles->pluck('id')->toArray();
        $this->position_id = $user->position_id; // ⬅️ set posisi
        $this->isEditing = true;
    }

    public function openModal($userId = null)
    {
        logger()->info('User ID diterima:', ['userId' => $userId]);
        $this->resetForm();

        if ($userId) {
            $this->loadUser($userId);
        } else {
            $this->isEditing = false;
        }

        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->userId = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->is_active = true;
        $this->selectedRoles = [];
        $this->position_id = null; // ⬅️ reset posisi
        $this->isEditing = false;
        $this->resetErrorBag();
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditing) {
            $user = User::findOrFail($this->userId);
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
                'is_active' => $this->is_active,
                'position_id' => $this->position_id, // ⬅️ simpan posisi
            ]);

            if ($this->password) {
                $user->update(['password' => Hash::make($this->password)]);
            }
        } else {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'is_active' => $this->is_active,
                'position_id' => $this->position_id, // ⬅️ simpan posisi
            ]);
        }

        $user->roles()->sync($this->selectedRoles);

        session()->flash('message', $this->isEditing ? 'User updated successfully.' : 'User created successfully.');

        $this->closeModal();
        $this->dispatch('userSaved');
    }

    public function render()
    {
        $roles = Role::where('is_active', true)->orderBy('name')->get();
        $positions = Position::where('is_active', true)->orderBy('title')->get(); // ⬅️ ambil daftar posisi

        return view('livewire.users.user-form', compact('roles', 'positions'));
    }
}
