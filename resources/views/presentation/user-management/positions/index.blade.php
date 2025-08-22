@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <livewire:user-managements.positions.positions-list />
        <livewire:user-managements.positions.positions-form />
    </div>
@endsection
