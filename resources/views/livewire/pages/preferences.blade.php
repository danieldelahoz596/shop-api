<div>
    <form wire:submit.prevent="savePreferences">
        <h2>Select Your Clothing Preferences</h2>

        <label>
            <input type="checkbox" wire:model="preferences.casual" value="casual">
            Casual
        </label>
        <br>

        <label>
            <input type="checkbox" wire:model="preferences.formal" value="formal">
            Formal
        </label>
        <br>

        <label>
            <input type="checkbox" wire:model="preferences.sports" value="sports">
            Sports
        </label>
        <br>

        @error('preferences') <span class="error">{{ $message }}</span> @enderror

        <button type="submit">Save Preferences</button>
    </form>
</div>
