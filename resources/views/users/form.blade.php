@if ($errors->any())
    <div class="mb-5 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-700">
        Please correct the highlighted form details and try again.
    </div>
@endif

<div class="grid gap-5">
    <label class="text-sm font-medium text-slate-700">
        Name
        <input name="name" value="{{ old('name', $user->name ?? '') }}" required class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-2 text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
        @error('name') <span class="mt-1 block text-xs text-red-600">{{ $message }}</span> @enderror
    </label>

    <label class="text-sm font-medium text-slate-700">
        Email
        <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" required class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-2 text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
        @error('email') <span class="mt-1 block text-xs text-red-600">{{ $message }}</span> @enderror
    </label>

    <label class="text-sm font-medium text-slate-700">
        Password{{ isset($user) ? ' (leave blank to keep current password)' : '' }}
        <input type="password" name="password" {{ isset($user) ? '' : 'required' }} minlength="8" class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-2 text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
        @error('password') <span class="mt-1 block text-xs text-red-600">{{ $message }}</span> @enderror
    </label>

    <label class="text-sm font-medium text-slate-700">
        Confirm password
        <input type="password" name="password_confirmation" {{ isset($user) ? '' : 'required' }} minlength="8" class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-2 text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
    </label>

    <label class="text-sm font-medium text-slate-700">
        Role
        <select name="role" required class="mt-2 w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
            <option value="user" @selected(old('role', $user->role ?? 'user') === 'user')>User</option>
            <option value="staff" @selected(old('role', $user->role ?? 'user') === 'staff')>Staff</option>
            <option value="admin" @selected(old('role', $user->role ?? 'user') === 'admin')>Admin</option>
        </select>
        @error('role') <span class="mt-1 block text-xs text-red-600">{{ $message }}</span> @enderror
    </label>
</div>

<div class="mt-6 flex justify-end gap-3">
    <a href="{{ route('users.index') }}" class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50">Cancel</a>
    <button type="submit" class="rounded-lg bg-blue-700 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-800">{{ $submitLabel }}</button>
</div>