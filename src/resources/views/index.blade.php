@extends('history::layouts.history_layout')
@section('content')
    <h1 class="mt-5">{{ __('history::history.header') }}</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('history::history.titles.user_id') }}</th>
            <th scope="col">{{ __('history::history.titles.client_ip') }}</th>
            <th scope="col">{{ __('history::history.titles.url') }}</th>
            <th scope="col">{{ __('history::history.titles.http_method') }}</th>
            <th scope="col">{{ __('history::history.titles.response_code') }}</th>
            <th scope="col">{{ __('history::history.titles.created_at') }}</th>
        </tr>
        </thead>
        <tbody>
        <form method="GET" action="{{route('history.index')}}">
        <tr>
            <td>
                <input type="submit" class="btn btn-primary" value="{{ __('history::history.buttons.apply_filters') }}">
                <div class="form-group mt-3">
                    <label>{{ __('history::history.labels.items_per_page') }}</label>
                    <select class="form-control" name="per_page">
                        @foreach($itemsPerPage as $variant)
                            <option {{ ($filters['per_page'] ?? null) == $variant ? 'selected' : ''}}>{{ $variant }}</option>
                        @endforeach
                    </select>
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="number" class="form-control" placeholder="{{ __('history::history.placeholders.user_id') }}" name="user_id" value="{{ $filters['user_id'] ?? '' }}">
                </div>
            </td>
            <td>
                <input type="text" class="form-control" placeholder="{{ __('history::history.placeholders.ip_address') }}" name="ip" value="{{ $filters['ip'] ?? '' }}">
            </td>
            <td>
                <input type="text" class="form-control" placeholder="{{ __('history::history.placeholders.url') }}" name="url" value="{{ $filters['url'] ?? '' }}">
            </td>
            <td>
                <div class="form-group">
                    <select class="form-control" name="method">
                        @foreach($methods as $key => $value)
                            <option value="{{ $value }}" {{ ($filters['method'] ?? null) == $value ? 'selected' : '' }}>{{ $key }}</option>
                        @endforeach
                    </select>
                </div>
            </td>
            <td>
                <input type="number" class="form-control" placeholder="{{ __('history::history.placeholders.response_code') }}" name="code" value="{{ $filters['code'] ?? '' }}">
            </td>
            <td>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">From</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="date_from" value="{{ $filters['date_from'] ?? '' }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">To</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="date_to" value="{{ $filters['date_to'] ?? '' }}">
                    </div>
                </div>
            </td>
        </tr>
        </form>
    @foreach($requests as $request)
            <tr>
                <th scope="row">{{ $request['id']}}</th>
                <td>{{ $request['user_id'] ?: __('history::history.guest') }}</td>
                <td>{{ $request['ip']}}</td>
                <td><a href="{{ $request['url'] }}">{{ $request['url']}}</a></td>
                <td>{{ $request['method']}}</td>
                <td>{{ $request['response_code'] }}</td>
                <td>{{ $request['created_at'] }}</td>
            </tr>
    @endforeach
        </tbody>
    </table>
    <div class="row justify-content-center mt-5 mb-5">
            {{ $requests->links() }}
    </div>
@endsection
