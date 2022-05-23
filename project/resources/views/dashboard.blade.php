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
                    You're logged in!

                    @can('isAdmin')
                        <h4>Admin Can Access This Portion!</h4>
                    @endcan

                    @can('isEditor')
                        <h4>Editor Can Access This Portion!</h4>
                    @endcan
                    @can('isUser')
                        <h4>User Can Access This Portion!</h4>
                    @endcan

                    @cannot('isAdmin')
                        sdfadzf
                    @endcannot

                    <a href="{{ route('gate') }}">Gate</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
