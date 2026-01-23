<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; }
        .container { padding: 20px; }
        .status { font-weight: bold; text-transform: uppercase; }
        .approved { color: green; }
        .rejected { color: red; }
    </style>
</head>
<body>
    <div class="container">
        <h2>{{ __('Hello') }}, {{ $borrowingRequest->user->name }}</h2>
        <p>{{ __('Your borrowing request') }} <strong>{{ $borrowingRequest->request_number }}</strong> {{ __('has been updated') }}.</p>
        
        <p>
            {{ __('New Status') }}: 
            <span class="status {{ $borrowingRequest->status }}">
                {{ ucfirst(str_replace('_', ' ', $borrowingRequest->status)) }}
            </span>
        </p>

        @if($borrowingRequest->status === 'rejected')
            <p>{{ __('Please contact the laboratory admin for more details.') }}</p>
        @endif

        <p>{{ __('Thank you') }},<br>
        {{ __('Laboratory Management System') }}</p>
    </div>
</body>
</html>
