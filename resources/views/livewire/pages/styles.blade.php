<div>
    <form wire:submit.prevent="saveStylesAndPreferences">
        <h2>Select Your Clothing Styles</h2>

        <label>
            <input type="checkbox" wire:model="styles.casual" value="casual">
            Casual
        </label>
        <br>

        <label>
            <input type="checkbox" wire:model="styles.formal" value="formal">
            Formal
        </label>
        <br>

        <label>
            <input type="checkbox" wire:model="styles.sports" value="sports">
            Sports
        </label>
        <br>

        @error('styles') <span class="error">{{ $message }}</span> @enderror

        <button type="submit">Save Styles</button>
    </form>
</div>
