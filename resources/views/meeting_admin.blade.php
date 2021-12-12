<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Meeting') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- @if($noZoomCode) --}}
                    <div class="alert alert-danger mb-3" role="alert">
                        <h4 class="alert-heading">Zoomとの連携を行います。</h4>

                        <a href="{{$zoomOuthLink}}" class="btn text-blue-500">Zoomと連携（OAuth認証）</a>
                    </div>
                    {{-- @else --}}
                    <h1></h1>
                    {{-- @endif --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
