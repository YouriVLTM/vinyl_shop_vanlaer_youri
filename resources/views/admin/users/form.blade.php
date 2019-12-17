@csrf
<div class="form-group">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name"
               class="form-control @error('name') is-invalid @enderror"
               placeholder="Name"
               minlength="3"
               required
               value="{{ old('name', $user->name) }}">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" id="email"
               class="form-control @error('email') is-invalid @enderror"
               placeholder="Email"
               minlength="3"
               required
               value="{{ old('email', $user->email) }}">
        @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="inlineActive" name="inlineActive" value="active" {{ old('active', $user->active) ? 'checked' : '' }}>
        <label class="form-check-label" for="inlineActive">Active</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="inlineAdmin" name="inlineAdmin" value="admin" {{ old('admin', $user->admin) ? 'checked' : '' }}>
        <label class="form-check-label" for="inlineAdmin">Admin</label>
    </div>



</div>
<button type="submit" class="btn btn-success">Save User</button>