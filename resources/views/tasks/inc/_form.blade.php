<?php
/**
 * @var App\Models\TodoList[] $task
 */


?>
<form method="POST" action="{{ isset($task) ? route('tasks.update', $task) : route('tasks.store') }}">
    @csrf
    @if(isset($task))
        @method('PUT')
    @endif
    <div class="mb-3">
        <label for="title" class=" form-label">Имя</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror"
               id="title" name="title"
               value="{{ old('tile', $task->title ?? '') }}">
        @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">description</label>
        <textarea type="text" class="form-control" rows="5"
                  id="description" name="description">
            {{old('description', $task->description ?? '')}}
        </textarea>
    </div>
    <button type="submit" class="btn btn-primary">
        {{ isset($task) ? 'Update' : 'Create' }}
    </button>
</form>
