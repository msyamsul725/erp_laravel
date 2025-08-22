@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <livewire:user-managements.departments.departments-list />
        <livewire:user-managements.departments.departments-form />

    </div>
@endsection
