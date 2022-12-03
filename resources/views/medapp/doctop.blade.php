<!DOCTYPE html>
<html lang="en">
@include('medapp.head')
<body class="min-h-screen bg-gray-100 dark:bg-gray-800">
    @include('medapp.header')
    <div class="container mx-auto px-5">
        <div class="flex justify-between px-2 my-5">
            <h2 class="font-bold text-3xl dark:text-slate-200">患者一覧</h2>
        </div>
        <dl class="block sm:hidden w-full text-sm text-left text-gray-500 dark:text-gray-400">
          @foreach($mypatients as $val)
          <div>
            <div class="">
              <dd class="text-md text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-200 py-3 px-6 text-xl font-bold">患者ID</dd>
              <dt class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-slate-400">{{ $val->id}}</dt>
            </div>
            <div class="">
              <dd class="text-md text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-200 py-3 px-6 text-xl font-bold">名前</dd>
              <dt class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-slate-400">{{ $val->name}}</dt>
            </div>
            <div class="">
              <dd class="text-md text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-200 py-3 px-6 text-xl font-bold">メールアドレス</dd>
              <dt class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-slate-400">{{ $val->email}}</dt>
            </div>
            <div class="mb-14">
              <dd class="text-md text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-200 py-3 px-6 text-xl font-bold">アカウント作成日時</dd>
              <dt class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-slate-400">{{ $val->created_at}}</dt>
              <div class="flex justify-between mx-1">
                <form action="{{ route ('show',['id' => $val->id ]) }}" method="post" class="mb-0 p-0 my-1">
                  @csrf
                      <input type="submit" name="sub_show" value="詳細" class="hover:cursor-pointer text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                      <input type="hidden" name="patientid" value="{{ $val->id }}">
                      <input type="hidden" name="patientname" value="{{ $val->name }}">
                      <input type="hidden" name="patientemail" value="{{ $val->email }}">
                      <input type="hidden" name="patientcreated_at" value="{{ $val->created_at }}">
                  </form>
                  <form action="{{ route ('removePatient',['id' => $val->id ]) }}" method="post" onsubmit="return confirm('削除しますか？')" class='h-[42px]'>
                    @csrf
                    <button class="mt-3" type="hidden" type="submit" id="delete"><ion-icon name="close-circle"></ion-icon></button>
                    <input type="hidden" name='id' value="{{ $val->id }}">
                  </form>
              </div>
            </div>
          @endforeach
        </dl>
        <table class="hidden sm:table w-full text-sm text-left text-gray-500 dark:text-gray-400 mb-6">
            <thead class="text-md text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th scope="col" class="py-3 px-6">患者ID</th>
                <th scope="col" class="py-3 px-6">名前</th>
                <th scope="col" class="py-3 px-6">メールアドレス</th>
                <th scope="col" class="py-3 px-6">アカウント作成日時</th>
                <th scope="col"></th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($mypatients as $info)
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $info->id }}</th>
                <td class="py-4 px-6">{{ $info->name }}さん</td>
                <td class="py-4 px-6">{{ $info->email }}</td>
                <td class="py-4 px-6">{{ $info->created_at }}</td>
                <td class="py-4 px-6">
                  <form action="{{ route ('show',['id' => $info->id ]) }}" method="post" class="mb-0 p-0">
                    @csrf
                        <input type="submit" name="sub_show" value="詳細" class="hover:cursor-pointer text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                        <input type="hidden" name="patientid" value="{{ $info->id }}">
                        <input type="hidden" name="patientname" value="{{ $info->name }}">
                        <input type="hidden" name="patientemail" value="{{ $info->email }}">
                        <input type="hidden" name="patientcreated_at" value="{{ $info->created_at }}">
                    </form>
                </td>
                <td class="py-4 pr-3">
                  <form action="{{ route ('removePatient',['id' => $info->id ]) }}" method="post" onsubmit="return confirm('削除しますか？')">
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