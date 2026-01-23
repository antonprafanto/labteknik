<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; }
        .container { padding: 20px; }
        .alert { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h2>{{ __('New Damage Report Submitted') }}</h2>
        <p class="alert">{{ __('Attention: A new item damage has been reported.') }}</p>
        
        <ul>
            <li><strong>{{ __('Item') }}:</strong> {{ $damageReport->inventoryItem->name }} ({{ $damageReport->inventoryItem->code }})</li>
            <li><strong>{{ __('Reporter') }}:</strong> {{ $damageReport->reporter->name }}</li>
            <li><strong>{{ __('Date') }}:</strong> {{ $damageReport->created_at->format('d M Y H:i') }}</li>
            <li><strong>{{ __('Severity') }}:</strong> {{ ucfirst($damageReport->damage_type) }}</li>
        </ul>

        <p><strong>{{ __('Description') }}:</strong></p>
        <p>{{ $damageReport->description }}</p>

        <p>{{ __('Please check the dashboard for more details and to take action.') }}</p>
        
        <a href="{{ route('damage-reports.show', $damageReport) }}">{{ __('View Report') }}</a>
    </div>
</body>
</html>
