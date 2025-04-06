<x-app-layout>

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Maintenance Logs</h1>
        <a href="{{ route('maintenance.index') }}" class="btn btn-outline-secondary">
            Back to Maintenance
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">{{ $maintenance->task }}</h3>
        </div>
        
        <div class="card-body">
            @if($logs->isEmpty())
                <div class="alert alert-info">No maintenance logs found</div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Completed At</th>
                                <th>Completed By</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logs as $log)
                                <tr>
                                    <td>{{ $log->completed_at->format('F j, Y \a\t g:i a') }}</td>
                                    <td>{{ $log->user->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="d-flex justify-content-center mt-4">
                    {{ $logs->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
</x-app-layout>