@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <livewire:inventory.receiving.manage-part-data.manage-part-data-form />
        <livewire:inventory.receiving.manage-part-data.manage-part-data-list />
    </div>
@endsection
