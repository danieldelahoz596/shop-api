<div>
    <form wire:submit.prevent="save">
        <!-- Username Field -->
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" wire:model.defer="user.username">
            @error('user.username') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Address Field -->
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" wire:model.defer="user.address">
            @error('user.address') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <!-- Profile Photo Field -->
        <div class="mb-3">
            <label for="photo" class="form-label">Profile Photo</label>
            <input type="file" class="form-control" id="photo" wire:model="photo">
            @error('photo') <span class="text-danger">{{ $message }}</span> @enderror

            <!-- Show the uploaded image preview -->
            @if ($photo)
            <img src="{{ $photo->temporaryUrl() }}" width="200" height="200">
            @endif
        </div>

        <!-- Update Button -->
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>

    <!-- Display Success Message -->
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
</div>