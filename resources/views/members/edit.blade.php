<x-app-layout>
    <x-slot name="title">Edit Member</x-slot>

    <div class="page-header">
        <div>
            <h1>Edit Member</h1>
            <p>Update {{ $member->name }}'s details</p>
        </div>
        <a href="{{ route('members.index') }}" class="btn-ghost">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5M12 5l-7 7 7 7"/>
            </svg>
            Back to members
        </a>
    </div>

    <div class="form-card">
        <form method="POST" action="{{ route('members.update', $member) }}">
            @csrf
            @method('PUT')

            <div class="form-grid-2">

                <div class="field full">
                    <label for="name">Full name <span style="color:var(--red)">*</span></label>
                    <input type="text" id="name" name="name"
                           value="{{ old('name', $member->name) }}"
                           placeholder="e.g. John Doe" required>
                    @error('name')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="field full">
                    <label for="email">Email address <span style="color:var(--red)">*</span></label>
                    <input type="email" id="email" name="email"
                           value="{{ old('email', $member->email) }}"
                           placeholder="e.g. john@example.com" required>
                    @error('email')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="field">
                    <label for="phone">Phone number</label>
                    <input type="text" id="phone" name="phone"
                           value="{{ old('phone', $member->phone) }}"
                           placeholder="e.g. +256 700 000 000">
                    @error('phone')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="field">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender">
                        <option value="" disabled>Select gender</option>
                        @foreach(['Male','Female','Other'] as $g)
                            <option value="{{ $g }}" {{ old('gender', $member->gender) === $g ? 'selected' : '' }}>{{ $g }}</option>
                        @endforeach
                    </select>
                    @error('gender')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="field full">
                    <label for="dob">Date of birth</label>
                    <input type="date" id="dob" name="dob"
                           value="{{ old('dob', $member->dob?->format('Y-m-d')) }}"
                           max="{{ date('Y-m-d') }}">
                    @error('dob')<span class="field-error">{{ $message }}</span>@enderror
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn-red">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v14a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>
                    </svg>
                    Save changes
                </button>
                <a href="{{ route('members.index') }}" class="btn-ghost">Cancel</a>
            </div>

        </form>
    </div>

</x-app-layout>