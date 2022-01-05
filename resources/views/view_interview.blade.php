<x-app-layout>
    <x-slot name="header_2">
        <br>
        <div class="row">
            <div class="col-md-11">
                <h1 class="pt-1 home-section font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('strings.view_interview') }}
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
            <div class="row">
                {{--Activity and form details--}}
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-1">
                                    <img class="activity-image" width="60" src="{{asset('images/list.png')}}">
                                </div>
                                <div class="col-11 row-2">
                                    <input id="latitude" value="{{$interview->latitude}}" type="hidden">
                                    <input id="longitude" value="{{$interview->longitude}}" type="hidden">
                                    <input id="location" value="{{$interview->customer_location}}" type="hidden">
                                    <p class="name"><i class="fas fa-signature"></i>&nbsp; {{$interview->title}}</p>
                                    <p><i class="fas fa-map-marker-alt "></i>&nbsp; {{$interview->customer_location}}
                                    </p>
                                    <p class=""><i class="far fa-clock"></i>&nbsp;{{$interview->created_at}}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <br>
                    <div class="card shadow">
                        <div class="card-body alert-secondary">
                            <strong>{{ __('strings.answers') }}</strong>
                            {{-- <input data-question-id="{{$form->id}}" class="rounded-md col-md-12 alert alert-light"
                                    type="text" placeholder="{{ __('strings.submission_title') }}">--}}
                        </div>
                    </div>
                    <div class="card shadow">
                        {{--<div class="card-header">Form body</div>--}}
                        <div class="card-body">
                            <input type="hidden" id="form_id" name="form_id" value="{{$form->id}}">
                            <input type="hidden" id="form_size" name="form_size" value="{{count($questions)}}">
                            {{--<input type="hidden" id="old_questions" name="old_questions" value="{{count($questions)}}">--}}
                            <ul id="form-body" class="questions-list list-group-item">
                                @if(count($questions)>0)
                                    @foreach($questions as $question)
                                        @if($question->type == 4)
                                            <li>
                                                <p class="mb-1">&nbsp; {{$question->title}}</p>
                                                <img style="object-fit: cover; width: 100%; height: 200px;"
                                                     src="@foreach($answers as $answer)@if($answer->questions_fk_id == $question->id){{'http://127.0.0.1:8000/storage/answer_images/'.$answer->answer}}@endif @endforeach">
                                            </li>
                                        @else
                                            <li>
                                                <p class="mb-1">&nbsp; {{$question->title}}</p>
                                                <p data-question-id="{{$question->id}}"
                                                   class="rounded-md col-md-12 alert alert-secondary">@foreach($answers as $answer)@if($answer->questions_fk_id == $question->id){{trim($answer->answer)}}@endif @endforeach</p>
                                            </li>
                                        @endif
                                        {{--@switch($question->type)
                                            @case(0)
                                            <li>
                                                <strong>&nbsp; {{$question->title}}</strong>
                                                <input data-question-id="{{$question->id}}"
                                                       class="rounded-md col-md-12 alert alert-secondary"
                                                       type="text" placeholder="{{$question->title}}"
                                                       value="@foreach($answers as $answer)@if($answer->questions_fk_id == $question->id){{trim($answer->answer)}}@endif @endforeach">
                                            </li>
                                            @break
                                            @case(1)
                                            <li>
                                                <strong>&nbsp; {{$question->title}}</strong>
                                                <textarea data-question-id="{{$question->id}}" rows="4"
                                                          class="rounded-md col-md-12 alert alert-secondary"
                                                          type="text"
                                                          placeholder="{{$question->title}}">@foreach($answers as $answer)@if($answer->questions_fk_id == $question->id){{$answer->answer}}@endif @endforeach</textarea>
                                            </li>
                                            @break
                                            @case(2)
                                            <li>
                                                <strong>&nbsp; {{$question->title}}</strong>
                                                <input data-question-id="{{$question->id}}"
                                                       class="rounded-md col-md-12 alert alert-secondary"
                                                       type="number" placeholder="{{$question->title}}"
                                                       value="@foreach($answers as $answer)@if($answer->questions_fk_id == $question->id){{$answer->answer}}@endif @endforeach">
                                            </li>
                                            @break
                                            @case(3)
                                            <li>
                                                <strong>&nbsp; {{$question->title}}</strong>
                                                <input data-question-id="{{$question->id}}"
                                                       class="rounded-md col-md-12 alert alert-secondary"
                                                       type="date" placeholder="{{$question->title}}"
                                                       value="@foreach($answers as $answer)@if($answer->questions_fk_id == $question->id){{$answer->answer}}@endif @endforeach">
                                            </li>
                                            @break
                                            @case(4)
                                            <li>
                                                <strong>&nbsp; {{$question->title}}</strong>
                                                <img style="object-fit: cover; height: 200px;"
                                                     src="@foreach($answers as $answer)@if($answer->questions_fk_id == $question->id){{'http://127.0.0.1:8000/storage/answer_images/'.$answer->answer}}@endif @endforeach">
                                            </li>
                                            @break
                                        @endswitch--}}

                                        {{--{!! $question->body !!}--}}
                                    @endforeach
                                @else
                                    <li class="btn btn-light text-center">
                                        <br>
                                        <br>
                                        <div>
                                            <i class="las la-boxes" style="font-size: 50px"></i>
                                            <p>{{ __('strings.no_questions') }}</p>
                                        </div>
                                        <br>
                                        <br>
                                    </li>
                                @endif
                            </ul>
                            {{--<button id="save_form" class="selector shadow btn btn-primary float-right"><i
                                    class="las la-save"></i> {{ __('strings.submit') }}
                            </button>--}}
                        </div>
                        <div class="card-footer">
                            <script>
                                // Initialize and add the map
                                function initMap() {
                                    var latitude = $('#latitude').val();
                                    var longitude = $('#longitude').val();
                                    var location = $('#location').val();
                                    // The location of Uluru
                                    console.log(latitude)
                                    console.log(longitude)
                                    const uluru = { lat: Number(latitude), lng: Number(longitude) };
                                    // The map, centered at Uluru
                                    const map = new google.maps.Map(document.getElementById("map"), {
                                        zoom: 8,
                                        center: uluru,
                                    });
                                    // The marker, positioned at Uluru
                                    const marker = new google.maps.Marker({
                                        position: uluru,
                                        map: map,
                                    });

                                }
                            </script>
                            <div id="map" style="height: 300px">

                            </div>
                            <script
                                    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap&libraries=&v=weekly"
                                    async
                            ></script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        {{--Must add defer to active js file--}}
        {{--<script type='text/javascript'
                src='https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap'
                async defer></script>--}}
        {{--<script
                src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap&libraries=&v=weekly"
                async
        ></script>
         <script src="{{asset('js/view_interview.js')}}" defer></script>
--}}

    @endpush
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
    <br>
</x-app-layout>
