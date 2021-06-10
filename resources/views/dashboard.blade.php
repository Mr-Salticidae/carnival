<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <a href="/create">Add a new reservation</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('error_message'))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="alert alert-alert">
                            {{ session('error_message') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        @if (empty($reservations))
                            No Reservation Yet
                        @else
                            <form action="/reservations/delete" method="post">
                                @csrf
                                @method('delete')
                                <table>
                                    <tr>
                                        <th>Reservation Date</th>
                                        <th>Reservation Code</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                    @foreach ($reservations as $reservation)
                                        <tr>
                                            <td>Day {{ $reservation->reservation_date }}</td>
                                            <td>{{ $reservation->reservation_code }}</td>
                                            @if ($reservation->status == 'Valid')
                                                <td class="text-green-500">{{ $reservation->status }}</td>
                                                <td><button type="submit" value={{ $reservation->id }}
                                                        name="reservation_id" class="text-red-500">Cancel</button></td>
                                            @else
                                                <td>{{ $reservation->status }}</td>
                                            @endif

                                        </tr>
                                    @endforeach
                                </table>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
