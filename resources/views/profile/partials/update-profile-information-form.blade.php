<section>
    <header class="flex items-center gap-6 mb-8">
        <div class="relative group">
            <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-slate-700 shadow-[0_0_20px_rgba(59,130,246,0.3)] bg-slate-900 flex items-center justify-center relative z-10">
                @if(Auth::user()->profile_photo)
                    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile Photo" class="w-full h-full object-cover">
                @else
                    <span class="text-3xl font-bold text-slate-500">{{ substr(Auth::user()->name, 0, 1) }}</span>
                @endif
            </div>
            <div class="absolute inset-0 bg-blue-500 rounded-full blur-xl opacity-20 group-hover:opacity-50 transition duration-500"></div>
        </div>

        <div>
            <h2 class="text-2xl font-bold text-slate-100">
                {{ __('Profile Information') }}
            </h2>
            <p class="mt-1 text-sm text-slate-400">
                {{ __("Update data diri dan foto avatar Engineer Anda di sini.") }}
            </p>
        </div>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="profile_photo" :value="__('Ganti Foto Profil')" class="text-slate-300" />
            <input type="file" id="profile_photo" name="profile_photo" accept="image/*" class="mt-2 block w-full text-sm text-slate-400
                file:mr-4 file:py-2 file:px-4
                file:rounded-full file:border-0
                file:text-sm file:font-semibold
                file:bg-blue-500/10 file:text-blue-400
                hover:file:bg-blue-500/20 file:transition
                cursor-pointer border border-slate-700/50 rounded-xl bg-slate-900/50 py-2 px-3 focus:outline-none" />
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('profile_photo')" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" class="text-slate-300" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full bg-slate-900/50 border-slate-700 text-slate-200 focus:border-blue-500 focus:ring-blue-500 rounded-xl" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-slate-300" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full bg-slate-900/50 border-slate-700 text-slate-200 focus:border-blue-500 focus:ring-blue-500 rounded-xl" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('email')" />
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-slate-700/50">
            <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2.5 px-6 rounded-xl shadow-[0_0_15px_rgba(37,99,235,0.4)] transition">
                {{ __('Save Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-400 font-semibold">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>