<!DOCTYPE html>
<html lang="en">
@include("medapp.head")
<body class="min-h-screen bg-gray-100 dark:bg-gray-800">
    @include("medapp.header")
    <form class="container mx-auto px-5" action="{{ route ('update',['id' => $data->id ]) }}" method='post'>
        @csrf
        <p class="text-slate-300 mt-3 dark:text-slate-500">({{ $data->id }}) 作成日時：{{ $data->date_of_creation }}
        @if(isset($data->date_of_update)){
            更新日時：{{ $data->date_of_update}}
        }
        @endif
       
        </p>
        <h2 class="font-bold text-3xl mt-3 mb-6 dark:text-slate-200">「{{ $data->name }}」を編集する</h2>
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-bold">薬名</label>
                <input value="{{ $data->name }}" name="name" placeholder="薬名1" type="text" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" required>
            </div>
            <div>
                <label for="day_check" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-bold">曜日 <span class="text-sky-500">({{ $data->days }})</span>
                </label>
                <div name="day_check"class="flex mt-4">
                    <div class="flex items-center mr-4">
                        <input name="days[]" id="inline-checkbox" type="checkbox" value="月" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="inline-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">月</label>
                    </div>
                    <div class="flex items-center mr-4">
                        <input name="days[]" id="inline-2-checkbox" type="checkbox" value="火" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="inline-2-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">火</label>
                    </div>
                    <div class="flex items-center mr-4">
                        <input name="days[]" id="inline-2-checkbox" type="checkbox" value="水" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="inline-2-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">水</label>
                    </div>
                    <div class="flex items-center mr-4">
                        <input name="days[]" id="inline-2-checkbox" type="checkbox" value="木" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="inline-2-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">木</label>
                    </div>
                    <div class="flex items-center mr-4">
                        <input name="days[]" id="inline-2-checkbox" type="checkbox" value="金" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="inline-2-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">金</label>
                    </div>
                    <div class="flex items-center mr-4">
                        <input name="days[]" id="inline-2-checkbox" type="checkbox" value="土" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="inline-2-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">土</label>
                    </div>
                    <div class="flex items-center mr-4">
                        <input name="days[]" id="inline-2-checkbox" type="checkbox" value="日" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="inline-2-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">日</label>
                    </div>
                </div>
            </div>
            <div>
                <label for="dosage" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-bold">数量</label>
                <div class="flex w-full">
                    <input value="{{ $data->amount }}" name="amount" type="text" id="dosage" class="flex-grow mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-fill p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="数量をご入力ください" required>
                    <select name="type" id="unit" class="min-w-[60px] bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-fill p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected class="min-w-full">{{ $data->type }}</option>
                        <option value="錠">錠</option>
                        <option value="個">個</option>
                        <option value="包">包</option>
                    </select>
                </div>
            </div>  
            <div>
                <label for="time_check" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-bold">時間帯 <span class="text-sky-500">({{ $data->time }})</span>
                </label>
                <div name="time_check"class="flex mt-4">
                    <div class="flex items-center mr-4">
                        <input name="time[]" id="inline-checkbox" type="checkbox" value="朝" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="inline-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">朝</label>
                    </div>
                    <div class="flex items-center mr-4">
                        <input name="time[]" id="inline-2-checkbox" type="checkbox" value="昼" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="inline-2-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">昼</label>
                    </div>
                    <div class="flex items-center mr-4">
                        <input name="time[]" id="inline-2-checkbox" type="checkbox" value="夕" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="inline-2-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">夕</label>
                    </div>
                    <div class="flex items-center mr-4">
                        <input name="time[]" id="inline-2-checkbox" type="checkbox" value="就寝前" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="inline-2-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">就寝前</label>
                    </div>
                </div>
            </div>
        </div>
        <label for="message" class="block mb-2 text-sm font-medium font-bold text-gray-900 dark:text-white">備考</label>
        <textarea name="comments" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="備考をご記入ください">{{ $data->comments }}</textarea>
        <div class="flex sm:flex-row-reverse flex-col justify-between my-6">
            <button type="submit" class="block sm:flex-grow mx-4 text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center font-bold">編集</button>
            <a href="
                {{ route('finishEdit', ['id' => $data->user_id]) }}
            " type="button" class="block sm:flex-grow mx-4 text-white bg-slate-200 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto my-4 sm:my-0 px-5 py-2.5 text-center dark:bg-gray-500 dark:hover:bg-blue-700 dark:focus:ring-blue-800 font-bold">戻る</a>
        </div>
    </form>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
@include("medapp.footer")
@include("medapp.flowbite")
</html>