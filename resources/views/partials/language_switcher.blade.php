@extends('master')
@section('content')

    <section class="content">
          <!-- Small boxes (Stat box) -->
          
          
      <h1>Languages</h1>
      <!-- <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
    @foreach($available_locales as $locale_name => $available_locale)
        @if($available_locale === $current_locale)
            <span class="ml-2 mr-2 text-gray-700">{{ $locale_name }}</span>
        @else
            <a class="ml-1 underline ml-2 mr-2" href="/{{ $available_locale }}">
                <span>{{ $locale_name }}</span>
            </a>
        @endif
    @endforeach -->
    <ul class="navbar-nav ml-auto">
        @foreach (config('app.available_locales') as $locale)
            <li class="nav-item">
                <a class="nav-link"
                    href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), $locale) }}"
                    @if (app()->getLocale() == $locale) style="font-weight: bold; text-decoration: underline" @endif>
                    @if($locale == 'en')
                        Eng
                    @endif
                    @if($locale == 'ur')
                        Urdu
                    @endif
                    @if($locale == 'sd')
                        Sindhi
                    @endif
                </a>
            </li>
        @endforeach
    </ul>
    {{ __('Welcome to our website') }}
</div>
    </section>


@stop