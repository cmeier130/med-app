<!DOCTYPE html>
<html lang="en">
@include('medapp.head')
<body class="min-h-screen bg-gray-100 dark:bg-gray-800">
    @include('medapp.header')
    <div class="container mx-auto px-5">
        <div class="flex justify-between px-2 my-6">
            <h2 class="font-bold text-3xl dark:text-slate-200">{{ $patientname }}さんの薬袋</h2>
            <a href="{{ route('add') }}">
            <button class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800">
              <span class="font-bold relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                追加
              </span>
            </button>
            </a>
        </div>
        <dl class="block sm:hidden w-full text-sm text-left text-gray-500 dark:text-gray-400">
          @foreach($mymeds as $val)
          <div>
            <div class="">
              <dd class="text-md text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-200 py-3 px-6 text-xl font-bold">薬名</dd>
              <dt class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-slate-400">{{ $val->name}}</dt>
            </div>
            <div class="">
              <dd class="text-md text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-200 py-3 px-6 text-xl font-bold">数量</dd>
              <dt class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-slate-400">{{ $val->amount . $val->type }}</dt>
            </div>
            <div class="">
              <dd class="text-md text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-200 py-3 px-6 text-xl font-bold">曜日</dd>
              <dt class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-slate-400">{{ $val->days}}</dt>
            </div>
            <div class="">
              <dd class="text-md text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-200 py-3 px-6 text-xl font-bold">時間帯</dd>
              <dt class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-slate-400">{{ $val->time}}</dt>
            </div>
            <div class="">
              <dd class="text-md text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-200 py-3 px-6 text-xl font-bold">備考</dd>
              <dt class="bg-white border-b dark:bg-gray-800 dark:border-gray-500 hover:bg-gray-50 dark:hover:bg-gray-600 py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-slate-400">{{ $val->comments}}</dt>
            </div>
            <div class="flex justify-between mt-1 mb-14 mx-1">
              <form action="{{ route ('edit',['id' => $val->id ]) }}" method="post" class="mb-0 p-0">
                @csrf
                    <input type="submit" name="sub_edit" value="編集" class="hover:cursor-pointer text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                    <input type="hidden" name="id" value="{{ $val->id }}">
                    <input type="hidden" name="name" value="{{ $val->name }}">
                    <input type="hidden" name="amount" value="{{ $val->amount }}">
                    <input type="hidden" name="type" value="{{ $val->type }}">
                    <input type="hidden" name="days" value="{{ $val->days }}">
                    <input type="hidden" name="time" value="{{ $val->time }}">
                    <input type="hidden" name="time" value="{{ $val->comments }}">
                </form>
                <form action="{{ route ('deletePOST',['id' => $val->id ]) }}" method="post" onsubmit="return confirm('削除しますか？')">
                  @csrf
                  <button class='mt-3' type="hidden" type="submit" id="delete"><ion-icon name="close-circle"></ion-icon></button>
                  <input type="hidden" name='id' value="{{ $val->id }}">
                </form>
            </div>
          @endforeach
        </dl>
        <table class="hidden sm:table w-full text-sm text-left text-gray-500 dark:text-gray-400 mb-6">
            <thead class="text-md text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th scope="col" class="py-3 px-6">薬名</th>
                <th scope="col" class="py-3 px-6">数量</th>
                <th scope="col" class="py-3 px-6">曜日</th>
                <th scope="col" class="py-3 px-6">時間帯</th>
                <th scope="col" class="py-3 px-6">備考</th>
                <th scope="col"></th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
            @foreach($mymeds as $info)
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $info->name }}</th>
                <td class="py-4 px-6">{{ $info->amount . $info->type }} </td>
                <td class="py-4 px-6">{{ $info->days }}</td>
                <td class="py-4 px-6">{{ $info->time }}</td>
                <td class="py-4 px-6">{{ $info->comments }}</td>
                <td class="py-4 px-3">
                  <form action="{{ route ('edit',['id' => $info->id ]) }}" method="post" class="mb-0 p-0">
                    @csrf
                        <input type="submit" name="sub_edit" value="編集" class="hover:cursor-pointer text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                        <input type="hidden" name="id" value="{{ $info->id }}">
                        <input type="hidden" name="name" value="{{ $info->name }}">
                        <input type="hidden" name="amount" value="{{ $info->amount }}">
                        <input type="hidden" name="type" value="{{ $info->type }}">
                        <input type="hidden" name="days" value="{{ $info->days }}">
                        <input type="hidden" name="time" value="{{ $info->time }}">
                        <input type="hidden" name="time" value="{{ $info->comments }}">
                    </form>
                </td>
                <td class="py-4 pr-3">
                  <form action="{{ route ('deletePOST',['id' => $info->id ]) }}" method="post" onsubmit="return confirm('削除しますか？')">
                    @csrf
                    <button type="hidden" type="submit" id="delete"><ion-icon name="close-circle"></ion-icon></button>
                    <input type="hidden" name='id' value="{{ $info->id }}">
                  </form>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
    </div>

    
@include('medapp.flowbite')
{{-- 削除アイコン --}}
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
@include('medapp.footer')
</html>