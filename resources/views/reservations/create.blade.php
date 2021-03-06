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
                        <center><b style="width:50px; height:5px; border:10px solid #ccc;">Create a new reservation</b></center>
                        <form action="/store" , method="POST">
                            @csrf
                            <ul>

                                @for ($i = env('CURRENT_DAY') + 1; $i <= env('CARNIVAL_DAYS'); $i++)
                                <center><li>Day {{ $i }} <button type="submit" name="date"
                                            value={{ $i }} class="text-green-500">Reserve</button></li></center>
                                @endfor
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
