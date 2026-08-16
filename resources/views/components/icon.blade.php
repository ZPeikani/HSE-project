@php $classes='h-5 w-5'; @endphp
@switch($name)
@case('home')<svg class="{{ $classes }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M3 11l9-8 9 8v9a1 1 0 01-1 1h-5v-7H9v7H4a1 1 0 01-1-1v-9z"/></svg>@break
@case('clipboard')<svg class="{{ $classes }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M9 5h6m-7 0a2 2 0 012-2h4a2 2 0 012 2h2a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h2zm1 6h6m-6 4h6"/></svg>@break
@case('warning')<svg class="{{ $classes }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M12 9v4m0 4h.01M10.3 4.5L2.7 18a2 2 0 001.7 3h15.2a2 2 0 001.7-3L13.7 4.5a2 2 0 00-3.4 0z"/></svg>@break
@case('incident')<svg class="{{ $classes }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M12 3v7m0 4v7M3 12h7m4 0h7M5.6 5.6l4.9 4.9m3 3l4.9 4.9m0-13.8l-4.9 4.9m-3 3l-4.9 4.9"/></svg>@break
@case('check')<svg class="{{ $classes }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M5 13l4 4L19 7"/></svg>@break
@case('list')<svg class="{{ $classes }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/></svg>@break
@case('chart')<svg class="{{ $classes }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M4 20V10m6 10V4m6 16v-7m5 7H2"/></svg>@break
@case('users')<svg class="{{ $classes }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m7-10a4 4 0 100-8 4 4 0 000 8zm8 1a4 4 0 014 4v2m-5-14a4 4 0 010 8"/></svg>@break
@case('building')<svg class="{{ $classes }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M4 21V4h10v17M8 8h2m-2 4h2m-2 4h2m6-6h4v11H2"/></svg>@break
@case('logout')<svg class="{{ $classes }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4m7 14l5-5-5-5m5 5H9"/></svg>@break
@case('bell')<svg class="{{ $classes }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M18 8a6 6 0 00-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9zm-8 13h4"/></svg>@break
@case('settings')<svg class="{{ $classes }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M12 15.5a3.5 3.5 0 100-7 3.5 3.5 0 000 7zM19.4 15a1.7 1.7 0 00.3 1.9l.1.1-2.8 2.8-.1-.1a1.7 1.7 0 00-1.9-.3 1.7 1.7 0 00-1 1.6v.2h-4V21a1.7 1.7 0 00-1-1.6 1.7 1.7 0 00-1.9.3l-.1.1L4.2 17l.1-.1a1.7 1.7 0 00.3-1.9A1.7 1.7 0 003 14H2.8v-4H3a1.7 1.7 0 001.6-1 1.7 1.7 0 00-.3-1.9L4.2 7 7 4.2l.1.1A1.7 1.7 0 009 4.6 1.7 1.7 0 0010 3V2.8h4V3a1.7 1.7 0 001 1.6 1.7 1.7 0 001.9-.3l.1-.1L19.8 7l-.1.1a1.7 1.7 0 00-.3 1.9 1.7 1.7 0 001.6 1h.2v4H21a1.7 1.7 0 00-1.6 1z"/></svg>@break
@default<svg class="{{ $classes }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" stroke-width="2"/></svg>
@endswitch
