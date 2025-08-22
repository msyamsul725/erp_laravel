@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <livewire:inventory.receiving.part-area.part-area-form />
        <livewire:inventory.receiving.part-area.part-area-list />
    </div>
@endsection
