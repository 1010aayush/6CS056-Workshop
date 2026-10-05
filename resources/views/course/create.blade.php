@extends('layouts.app')

@section('title', 'Create Course')

@section('content')
    <h1>Create Course</h1>

    @include('partials.errors')

    <form action="{{ route('courses.store') }}" method="POST">
        @csrf

        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}">
        </div>
        <br>

        <div>
            <label for="description">Description</label>
            <textarea id="description" name="description">{{ old('description') }}</textarea>
        </div>
        <br>

        <div>
            <label for="duration">Duration (weeks)</label>
            <input type="number" id="duration" name="duration" value="{{ old('duration') }}">
        </div>
        <br>

        <div>
            <label for="fee">Fee</label>
            <input type="number" step="0.01" id="fee" name="fee" value="{{ old('fee') }}">
        </div>
        <br>

        <div>
            <label for="difficulty">Difficulty</label>
            <select id="difficulty" name="difficulty">
                <option value="">-- Select --</option>
                @foreach(['Easy', 'Medium', 'Hard'] as $level)
                    <option
                        value="{{ $level }}"
                        {{ old('difficulty') === $level ? 'selected' : '' }}
                    >
                        {{ $level }}
                    </option>
                @endforeach
            </select>
        </div>
        <br>

        <div>
            <input type="hidden" name="is_active" value="0">
            <label>
                <input
                    type="checkbox"
                    id="is_active"
                    name="is_active"
                    value="1"
                    {{ old('is_active', true) ? 'checked' : '' }}
                >
                Active
            </label>
        </div>
        <br>

        <button type="submit">Create Course</button>
    </form>

    <br>
    <a href="{{ route('courses.index') }}">Back to Courses</a>
@endsection