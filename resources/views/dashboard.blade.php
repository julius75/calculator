<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Calculator Page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="api/vuvuzela">
                        @csrf
                        First number:
                        <input type="number" name="a"  required />
                        <br />
                        <br>
                        Second number:
                        <input type="number" name="b"  required/>
                        <br />
                        <br>
                        Operation:
                        <select name="operation" required>
                            <option value="add">Add</option>
                            <option value="subtract">Subtract</option>
                            <option value="multiply">Multiply</option>
                            <option value="divide">Divide</option>
                        </select>
                        <br />
                        <button class="button b" id="submitbtn" type="submit">Calculate the result</button>
                    </form>
                    @if (isset($result))
                        <p>The result is: {{ $result }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


