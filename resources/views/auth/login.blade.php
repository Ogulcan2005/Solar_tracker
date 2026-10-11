@extends('layouts.auth')

@section('title', 'Inloggen')

@section('content')
    <div class="rounded-2xl border-2 border-[var(--esg-petrol)] bg-white p-6 shadow-sm sm:p-8">
        <p class="inline-block rounded-full bg-[var(--esg-gold)] px-3 py-1 text-xs font-bold text-[var(--esg-petrol)]">
            Beveiligd
        </p>
        <h1 class="mt-3 text-2xl font-bold text-[var(--esg-petrol)]">Inloggen</h1>
        <p class="mt-2 text-sm leading-relaxed text-[var(--esg-teal)]">
            Log in om het Solar Tracker dashboard te bekijken.
        </p>

        @if ($errors->any())
            <div class="mt-4 rounded-xl border-2 border-[#fca5a5] bg-[#fee2e2] px-4 py-3 text-sm text-[#991b1b]">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-semibold text-[var(--esg-petrol)]">E-mailadres</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    class="mt-2 w-full rounded-xl border-2 border-[var(--esg-mist)] px-4 py-2.5 text-sm text-[var(--esg-petrol)] outline-none focus:border-[var(--esg-teal)] focus:ring-2 focus:ring-[var(--esg-teal)]/20"
                >
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-[var(--esg-petrol)]">Wachtwoord</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    class="mt-2 w-full rounded-xl border-2 border-[var(--esg-mist)] px-4 py-2.5 text-sm text-[var(--esg-petrol)] outline-none focus:border-[var(--esg-teal)] focus:ring-2 focus:ring-[var(--esg-teal)]/20"
                >
            </div>

            <label class="flex items-center gap-2 text-sm text-[var(--esg-teal)]">
                <input
                    type="checkbox"
                    name="remember"
                    class="h-4 w-4 rounded border-[var(--esg-mist)] text-[var(--esg-petrol)] focus:ring-[var(--esg-gold)]"
                    @checked(old('remember'))
                >
                Onthoud mij
            </label>

            <button
                type="submit"
                class="w-full rounded-xl bg-[var(--esg-petrol)] px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[var(--esg-teal)]"
            >
                Inloggen
            </button>
        </form>
    </div>
@endsection
