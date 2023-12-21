@props([
    'align' => 'right',
])

<div class="relative inline-flex" x-data="{ open: false }">
    <button class="inline-flex justify-center items-center group" aria-haspopup="true" @click.prevent="open = !open"
        :aria-expanded="open">
        @if (Auth::user()->profile_photo_path == null)
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 48 48">
                <g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                    <path d="M24 27a8 8 0 1 0 0-16a8 8 0 0 0 0 16Zm0-2a6 6 0 1 0 0-12a6 6 0 0 0 0 12Z" />
                    <path
                        d="M44 24c0 11.046-8.954 20-20 20S4 35.046 4 24S12.954 4 24 4s20 8.954 20 20ZM33.63 39.21A17.915 17.915 0 0 1 24 42a17.916 17.916 0 0 1-9.832-2.92c-.24-.3-.483-.61-.73-.93A2.144 2.144 0 0 1 13 36.845c0-1.077.774-1.98 1.809-2.131c6.845-1 11.558-.914 18.412.035A2.077 2.077 0 0 1 35 36.818c0 .48-.165.946-.463 1.31c-.307.374-.61.735-.907 1.082Zm3.355-2.744c-.16-1.872-1.581-3.434-3.49-3.698c-7.016-.971-11.92-1.064-18.975-.033c-1.92.28-3.335 1.856-3.503 3.733A17.94 17.94 0 0 1 6 24c0-9.941 8.059-18 18-18s18 8.059 18 18a17.94 17.94 0 0 1-5.015 12.466Z" />
                </g>
            </svg>
        @else
            <img class="w-14 h-14 rounded-full" src="{{ asset('foto-profil/' . Auth::user()->profile_photo_path) }}"
                width="20" height="5" alt="{{ Auth::user()->name }}" />
        @endif

        <div class="flex items-center truncate">
            <span
                class="truncate ml-2 text-sm font-medium dark:text-slate-300 group-hover:text-slate-800 dark:group-hover:text-slate-200">{{ Auth::user()->name }}</span>
            <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400" viewBox="0 0 12 12">
                <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
            </svg>
        </div>
    </button>
    <div class="origin-top-right z-10 absolute top-full min-w-44 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 py-1.5 rounded shadow-lg overflow-hidden mt-1 {{ $align === 'right' ? 'right-0' : 'left-0' }}"
        @click.outside="open = false" @keydown.escape.window="open = false" x-show="open"
        x-transition:enter="transition ease-out duration-200 transform"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-out duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" x-cloak>
        <div class="pt-0.5 pb-2 px-3 mb-1 border-b border-slate-200 dark:border-slate-700">
            <div class="font-medium text-slate-800 dark:text-slate-100">{{ Auth::user()->name }}</div>
            <div class="text-xs text-slate-500 dark:text-slate-400 italic">{{ Auth::user()->role }}</div>
        </div>
        <ul>
            <li>
                <a class="font-medium text-sm text-indigo-500 hover:text-indigo-600 dark:hover:text-indigo-400 flex items-center py-1 px-3"
                    href="/profil" @click="open = false" @focus="open = true" @focusout="open = false">Profil</a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <a class="font-medium text-sm text-indigo-500 hover:text-indigo-600 dark:hover:text-indigo-400 flex items-center py-1 px-3"
                        href="{{ route('logout') }}" @click.prevent="$root.submit();" @focus="open = true"
                        @focusout="open = false">
                        {{ __('Keluar') }}
                    </a>
                </form>
            </li>
        </ul>
    </div>
</div>
