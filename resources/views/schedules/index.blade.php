<x-app-layout>
@foreach ($tasks as $task)
    <div>
        <p>{{ $task->task }} - {{ $task->schedule_date }}</p>
        <form method="POST" action="{{ route('schedules.update', $task->id) }}">
            @csrf
            @method('PUT')
            <select name="status">
                <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
            </select>
            <button type="submit">Update</button>
        </form>
    </div>
@endforeach
</x-app-layout>
