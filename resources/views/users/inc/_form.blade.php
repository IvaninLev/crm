<?php
/** @var \App\Models\User $user */



?>

<form method="POST"
      action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}"
      enctype="multipart/form-data">
    @csrf
    @isset($user)
        @method('PUT')
    @endisset

    <div class="mb-3">
        <label for="name" class="form-label">Имя</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror"
               id="name" name="name"
               value="{{ old('name', $user->name ?? '') }}">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror"
               id="email" name="email"
               value="{{ old('email', $user->email ?? '') }}">
        @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Пароль</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror"
               id="password" name="password">
        @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Подтвердите пароль</label>
        <input type="password" class="form-control"
               id="password_confirmation" name="password_confirmation">
    </div>

    <div class="mb-3">
        <label for="task" class="form-label">Задачи</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror"
               id="task" name="task"
               value="{{ old('task', $user->task ?? '') }}">
        @error('task')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="role" class="form-label">Роль</label>
        <select class="form-select form-select-lg @error('role') is-invalid @enderror"
                id="role" name="role">
            @php
                $currentRole = old('role', $user->role ?? 'user');
            @endphp

            <option value="user" {{ $currentRole == 'user' ? 'selected' : '' }}>
                Обычный пользователь
            </option>
            <option value="admin" {{ $currentRole == 'admin' ? 'selected' : '' }}>
                Администратор
            </option>
        </select>
        @error('role')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="avatar" class="form-label">Аватар</label>
        <input type="file" class="form-control @error('avatar') is-invalid @enderror"
               id="avatar" name="avatar">
        @error('avatar')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        @isset($user->avatar)
            <div class="mt-2">
                <small>Текущий аватар:</small>
                <img src="{{ asset('storage/' . $user->avatar) }}" width="80" class="d-block mt-1">
            </div>
        @endisset
    </div>

    <button type="submit" class="btn btn-primary">
        {{ isset($user) ? 'Update' : 'Create' }}
    </button>
</form>
