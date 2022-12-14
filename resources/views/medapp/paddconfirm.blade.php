<!DOCTYPE html>
<html lang="en">
@include("medapp.head")
<body class="min-h-screen bg-gray-100 dark:bg-gray-800">
    @include("medapp.header")
    <form class="container mx-auto px-5" action="{{ route('psend') }}" method="POST">
        @csrf
        <h2 class="font-bold text-3xl my-5 dark:text-white">内容確認</h2>
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <dd class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-bold">薬名</dd>
                <dt class="min-h-[42px] bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $input['name'] }}</dt>
            </div>
            <div>
                <dd class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-bold">曜日
                </dd>
                <dt class="min-h-[42px] bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @if(isset($input['days']))
                    {{ implode("、", $input['days']) }}</dt>
                    @endif
            </div>
            <div>
                <dd class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-bold">数量</dd>
                <dt class="min-h-[42px] bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $input['amount'] . $input['type'] }}</dt>
            </div>  
            <div>
                <dd class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-bold">時間帯
                </dd>
                <dt class="min-h-[42px] bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @if(isset($input['time']))
                    {{ implode("、", $input['time']) }}</dt>
                    @endif
            </div>
        </div>
        <dd class="block mb-2 text-sm font-medium font-bold text-gray-900 dark:text-white">備考</っd>
            <dt class="min-h-[42px] bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $input['comments'] }}</dt>
        <div class="flex sm:flex-row-reverse flex-col justify-between my-6">
            <button name="finalize" type="submit" class="block sm:flex-grow mx-4 text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center font-bold">追加</button>
            <button name="con_cancel" id="con_cancel" type="submit" class="con_cancel block sm:flex-grow mx-4 text-white bg-slate-200 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto my-4 sm:my-0 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 font-bold">戻る</button>
        </div>
    </form>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
@include("medapp.footer")
@include("medapp.flowbite")
</html>