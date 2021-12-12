<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Meeting info') }}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1>以下の内容でMeeting作成</h1>
                    <li>
                        <ul>話者・内容：{{ $result_array['topic']  }}</ul>
                        <ul>日時　　　：{{ $result_array['startAt'] }}</ul>
                        <ul>開始URL　 ：<a href="{{ $result_array['startUrl'] }}" class="text-blue-500">ミーティングに参加</a></ul>

                    </li>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
