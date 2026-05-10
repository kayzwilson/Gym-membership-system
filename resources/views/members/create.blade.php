<x-app-layout>
    <x-slot name="title">Add Member</x-slot>

    {{-- Header --}}
    <div class="page-header">
        <div>
            <h1>Add Member</h1>
            <p>Register a new gym member</p>
        </div>
        <a href="{{ route('members.index') }}" class="btn-ghost">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5M12 5l-7 7 7 7"/>
            </svg>
            Back to members
        </a>
    </div>

    <div class="form-card">
        <form method="POST" action="{{ route('members.store') }}">
            @csrf

            <div class="form-grid-2">

                {{-- Name --}}
                <div class="field full">
                    <label for="name">Full name <span style="color:var(--red)">*</span></label>
                    <input type="text" id="name" name="name"
                           value="{{ old('name') }}"
                           placeholder="e.g. John Doe"
                           required>
                    @error('name')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="field full">
                    <label for="email">Email address <span style="color:var(--red)">*</span></label>
                    <input type="email" id="email" name="email"
                           value="{{ old('email') }}"
                           placeholder="e.g. john@example.com"
                           required>
                    @error('email')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Phone --}}
                <div class="field">
                    <label for="phone">Phone number</label>
                    <input type="text" id="phone" name="phone"
                           value="{{ old('phone') }}"
                           placeholder="e.g. +256 700 000 000">
                    @error('phone')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Gender --}}
                <div class="field">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender">
                        <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select gender</option>
                        <option value="Male"   {{ old('gender') === 'Male'   ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other"  {{ old('gender') === 'Other'  ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('gender')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Date of birth --}}
                <div class="field full">
                    <label for="dob">Date of birth</label>
                    <input type="date" id="dob" name="dob"
                           value="{{ old('dob') }}"
                           max="{{ date('Y-m-d') }}">
                    @error('dob')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn-red">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    Register member
                </button>
                <a href="{{ route('members.index') }}" class="btn-ghost">Cancel</a>
            </div>

        </form>
    </div>

</x-app-layout>