<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-200 leading-tight flex items-center gap-2">
            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            {{ __('Engineer Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="p-4 sm:p-8 bg-slate-800/50 backdrop-blur-xl border border-slate-700/50 shadow-[0_0_30px_rgba(0,0,0,0.3)] rounded-3xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-slate-800/50 backdrop-blur-xl border border-slate-700/50 shadow-[0_0_30px_rgba(0,0,0,0.3)] rounded-3xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-slate-800/50 backdrop-blur-xl border border-slate-700/50 shadow-[0_0_30px_rgba(0,0,0,0.3)] rounded-3xl">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>