{{-- resources/views/plans/create.blade.php --}}
<x-app-layout>
    <x-slot name="title">New Plan</x-slot>

    <div class="page-header">
        <div>
            <h1>New Plan</h1>
            <p>Create a new membership plan</p>
        </div>
        <a href="{{ route('plans.index') }}" class="btn-ghost">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5M12 5l-7 7 7 7"/>
            </svg>
            Back to plans
        </a>
    </div>

    <div class="form-card">
        <form method="POST" action="{{ route('plans.store') }}">
            @csrf

            <div class="form-grid-2">

                <div class="field full">
                    <label for="name">Plan name <span style="color:var(--red)">*</span></label>
                    <input type="text" id="name" name="name"
                           value="{{ old('name') }}"
                           placeholder="e.g. Monthly Premium"
                           required>
                    @error('name')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="field">
                    <label for="price">Price (UGX) <span style="color:var(--red)">*</span></label>
                    <input type="number" id="price" name="price"
                           value="{{ old('price') }}"
                           placeholder="e.g. 150000"
                           min="0" step="500" required>
                    @error('price')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="field">
                    <label for="duration_days">Duration (days) <span style="color:var(--red)">*</span></label>
                    <input type="number" id="duration_days" name="duration_days"
                           value="{{ old('duration_days') }}"
                           placeholder="e.g. 30"
                           min="1" required>
                    @error('duration_days')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="field full">
                    <label for="description">Description</label>
                    <textarea id="description" name="description"
                              rows="3"
                              placeholder="Optional — briefly describe what this plan includes...">{{ old('description') }}</textarea>
                    @error('description')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                {{-- Quick presets --}}
                <div class="field full">
                    <label>Quick presets</label>
                    <div style="display:flex; gap:8px; flex-wrap:wrap;">
                        <button type="button" onclick="setPreset('Monthly', 30)"
                                style="background:transparent; border:1px solid var(--border); color:var(--soft); padding:6px 14px; border-radius:6px; font-family:inherit; font-size:13px; cursor:pointer; transition:border-color .2s, color .2s;"
                                onmouseover="this.style.borderColor='#333'; this.style.color='#fff';"
                                onmouseout="this.style.borderColor='var(--border)'; this.style.color='var(--soft)';">
                            Monthly (30 days)
                        </button>
                        <button type="button" onclick="setPreset('Quarterly', 90)"
                                style="background:transparent; border:1px solid var(--border); color:var(--soft); padding:6px 14px; border-radius:6px; font-family:inherit; font-size:13px; cursor:pointer; transition:border-color .2s, color .2s;"
                                onmouseover="this.style.borderColor='#333'; this.style.color='#fff';"
                                onmouseout="this.style.borderColor='var(--border)'; this.style.color='var(--soft)';">
                            Quarterly (90 days)
                        </button>
                        <button type="button" onclick="setPreset('Annual', 365)"
                                style="background:transparent; border:1px solid var(--border); color:var(--soft); padding:6px 14px; border-radius:6px; font-family:inherit; font-size:13px; cursor:pointer; transition:border-color .2s, color .2s;"
                                onmouseover="this.style.borderColor='#333'; this.style.color='#fff';"
                                onmouseout="this.style.borderColor='var(--border)'; this.style.color='var(--soft)';">
                            Annual (365 days)
                        </button>
                    </div>
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn-red">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    Create plan
                </button>
                <a href="{{ route('plans.index') }}" class="btn-ghost">Cancel</a>
            </div>

        </form>
    </div>

    <script>
        function setPreset(name, days) {
            document.getElementById('name').value = name;
            document.getElementById('duration_days').value = days;
        }
    </script>

</x-app-layout>