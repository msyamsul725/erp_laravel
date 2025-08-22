@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <livewire:inventory.receiving.head-location.head-location-form />
        <livewire:inventory.receiving.head-location.head-location-list />
    </div>
@endsection
