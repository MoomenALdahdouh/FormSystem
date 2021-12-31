<x-app-layout>
    <x-slot name="header_2">
        <br>
        <div class="row">
            <div class="col-md-11">
                <h1 class="pt-1 home-section font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('strings.interviews') }}
                </h1>
            </div>
            {{--Select language--}}
            <div class="col-md-1">
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button"
                            id="dropdownMenuButton1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                        <i class="fas fa-globe"></i>&nbsp; {{ Config::get('language')[App::getLocale()] }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        @foreach (Config::get('language') as $lang => $language)
                            @if ($lang != App::getLocale())
                                <li>
                                    <a class="dropdown-item"
                                       href="{{ route('lang.switch', $lang) }}"> {{$language}}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </x-slot>
    <br>
    <br>
    <div class="header-section">
        <div class="container">
            <input id="interviews_page" type="hidden" value="1">
            <div class="row section-tow">
                <p class="mt-3"><i class='bx bxl-react'></i>&nbsp;<strong>{{__('strings.forms_activity')}}</strong></p>
                <div class="col-md-12">
                    <div class="table-responsive" style="padding: 30px">
                        <table id="interviews-table" class="text-center table table-bordered table-striped"
                               style="width: 100%; padding-top: 30px;margin-bottom: 15px">
                            <thead class="text-light hint" style="background-color: #525256;">
                            <tr>
                                <th>{{__('strings.sl_no')}}</th>
                                <th>{{__('strings.title')}}</th>
                                <th>{{__('strings.location')}}</th>
                                <th>{{__('strings.created_at')}}</th>
                                <th>{{__('strings.action')}}</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('modal_alert')
        @push('js')
            <script src="{{asset('js/interview.js')}}" defer></script> {{--Must add defer to active js file--}}
        @endpush
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
</x-app-layout>
