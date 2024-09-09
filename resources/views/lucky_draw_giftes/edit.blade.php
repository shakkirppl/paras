@extends('layouts.layout')

@section('content')
<div class="container">
    <h2>Edit Gift</h2>
    
    <form action="{{ route('lucky_draw_giftes.update', $gift->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="name" class="form-label">Gift Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $gift->name }}" required>
        </div>
        
        <div class="mb-3">
            <label for="short_description" class="form-label">Short Description</label>
            <textarea class="form-control" id="short_description" name="short_description">{{ $gift->short_description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description">{{ $gift->description }}</textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Update Gift</button>
    </form>
</div>
@endsection
