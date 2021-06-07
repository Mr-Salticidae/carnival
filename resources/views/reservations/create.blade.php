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
                        <b>Create a new reservation</b>
                        <form action="/reservations" , method="POST">
                            @csrf
                            <ul>
                                <li>Day 1 <button type="submit" name="date" value="1"
                                        class="text-green-500">Reserve</button></li>
                                <li>Day 2 <button type="submit" name="date" value="2"
                                        class="text-green-500">Reserve</button></li>
                                <li>Day 3 <button type="submit" name="date" value="3"
                                        class="text-green-500">Reserve</button></li>
                                <li>Day 4 <button type="submit" name="date" value="4"
                                        class="text-green-500">Reserve</button></li>
                                <li>Day 5 <button type="submit" name="date" value="5"
                                        class="text-green-500">Reserve</button></li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
