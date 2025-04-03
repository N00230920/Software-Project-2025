@props([])

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

<!-- Maintenance -->

<!-- Task icons -->
<div class="p-1">
                <div class="max-w-7xl">
                    <div class="bg-green-200 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="font-semibold text-lg mb-4 ">Maintenance</h3>
                            <div class="bg-white p-12 mb-4 rounded-lg">
                            <div class="flex flex-row gap-2 justify-between">
                                <div class="text-center p-5 border-2 border-black">
                                    <h2>Watering</h2>
                                    <p>Water your plant every 2-3 days</p>
                                </div>
                                <div class="text-center p-5 border-2 border-black">
                                    <h2>Watering</h2>
                                    <p>Water your plant every 2-3 days</p>
                                </div>

                                <div class="text-center p-5 border-2 border-black">
                                    <h2>Watering</h2>
                                    <p>Water your plant every 2-3 days</p>
                                </div>

                            </div>
                        </div>
<!-- To do checklist -->
                        <h3 class="font-semibold text-lg mb-4 ">To do:</h3>
                        <div class="form-check">
                            <label class="form-check-label" for="flexCheckDefault">
                                Default checkbox
                            </label>
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            </div>

                            <div class="form-check">

                            <label class="form-check-label" for="flexCheckChecked">
                                Checked checkbox
                            </label>
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>

                        </div>

                        <!-- History -->
                        <div class="py-12">
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 text-gray-900">
                                        <h3 class="font-semibold text-lg mb-4">RECENT</h3>
                                        <p>Watered - 2 days ago</p>
                                    </div>
                                </div>
                            </div>
                        </div>