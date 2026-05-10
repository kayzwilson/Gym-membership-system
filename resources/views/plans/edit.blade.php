<x-app-layout>
    <x-slot name="title">Edit Plan</x-slot>

    <div class="page-header">
        <div>
            <h1>Edit Plan</h1>
            <p>Update {{ $plan->name }}</p>
        </div>
        <a href="{{ route('plans.index') }}" class="btn-ghost">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5M12 5l-7 7 7 7"/>
            </svg>
            Back to plans
        </a>
    </div>

    <div class="form-card">
        <form method="POST" action="{{ route('plans.update', $plan) }}">
            @csrf
            @method('PUT')

            <div class="form-grid-2">

                <div class="field full">
                    <label for="name">Plan name <span style="color:var(--red)">*</span></label>
                    <input type="text" id="name" name="name"
                           value="{{ old('name', $plan->name) }}"
                           placeholder="e.g. Monthly Premium"
                           required>
                    @error('name')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="field">
                    <label for="price">Price (UGX) <span style="color:var(--red)">*</span></label>
                    <input type="number" id="price" name="price"
                           value="{{ old('price', $plan->price) }}"
                           placeholder="e.g. 150000"
                           min="0" step="500" required>
                    @error('price')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="field">
                    <label for="duration_days">Duration (days) <span style="color:var(--red)">*</span></label>
                    <input type="number" id="duration_days" name="duration_days"
                           value="{{ old('duration_days', $plan->duration_days) }}"
                           placeholder="e.g. 30"
                           min="1" required>
                    @error('duration_days')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="field full">
                    <label for="description">Description</label>
                    <textarea id="description" name="description"
                              rows="3"
                              placeholder="Optional description...">{{ old('description', $plan->description) }}</textarea>
                    @error('description')<span class="field-error">{{ $message }}</span>@enderror
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn-red">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v14a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>
                    </svg>
                    Save changes
                </button>
                <a href="{{ route('plans.index') }}" class="btn-ghost">Cancel</a>
            </div>

        </form>
    </div>

</x-app-layout>