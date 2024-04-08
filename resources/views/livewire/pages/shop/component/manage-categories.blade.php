<div>
    <!-- Display existing categories -->
    @if($categories->isNotEmpty())
    <ul>
        @foreach ($categories as $category)
        <li>{{ $category->name }}</li>
        @endforeach
    </ul>
    @endif

    <!-- Form to add a new category -->
    <form wire:submit.prevent="addCategory">
        <input type="text" wire:model="name" placeholder="New Category Name">
        <button type="submit">Add Category</button>
    </form>

    <!-- Display Success Message -->
    @if (session()->has('message'))
    <div>{{ session('message') }}</div>
    @endif
</div>