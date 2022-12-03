<!DOCTYPE html>
<html lang="en">
@include('medapp.head')
<body class="min-h-screen bg-gray-100 dark:bg-gray-800">
    @include('medapp.header')
    <div class="container mx-auto px-5 pt-2 pb-4">
        <div class="flex justify-between px-2 my-3">
            <h2 class="font-bold text-3xl dark:text-slate-200 mb-2">ユーザ一覧</h2>
        </div>
        <dl class="block sm:hidden w-full text-sm text-left text-gray-500 dark:text-gray-400">
          @foreach($users as $val)
          <div>
            <div class="">
              <dd class="text-md text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-200 py-3 px-6 text-xl font-bold">ユーザID</dd>
              <dt class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-slate-400">{{ $val->id}}</dt>
            </div>
            <div class="">
              <dd class="text-md text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-200 py-3 px-6 text-xl font-bold">メールアドレス</dd>
              <dt class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-slate-400">{{ $val->email }}</dt>
            </div>
            <div class="">
              <dd class="text-md text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-200 py-3 px-6 text-xl font-bold">ユーザ権限</dd>
              <dt class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-slate-400">
                @if ($val->role === 0)
                  一般ユーザ
                @elseif($val->role === 1)
                  医療関係者
                @endif
              </dt>
            </div>
            <div class="">
              <dd class="text-md text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-200 py-3 px-6 text-xl font-bold">アカウント作成日時</dd>
              <dt class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-slate-400">{{ $val->created_at}}</dt>
            </div>
            <div class='mb-14 w-full flex justify-center'>
              <form class='mt-1' action="{{ route ('deleteUser',['id' => $val->id ]) }}" method="post" onsubmit="return confirm('削除しますか？')">
                @csrf
                <button type="hidden" type="submit" id="delete"><ion-icon name="close-circle"></ion-icon></button>
                <input type="hidden" name='id' value="{{ $val->id }}">
              </form>
            </div>

          @endforeach
        </dl>
        <table class="hidden sm:table w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-md text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th scope="col" class="py-3 px-6">ユーザID</th>
                <th scope="col" class="py-3 px-6">メールアドレス</th>
                <th scope="col" class="py-3 px-6">ユーザ権限</th>
                <th scope="col" class="py-3 px-6">アカウント作成日時</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $user->id }}</th>
                <td class="py-4 px-6">{{ $user->email }}</td>
                <td class="py-4 px-6">
                @if ($user->role === 0)
                  一般ユーザ
                @elseif($user->role === 1)
                  医療関係者
                @endif
                </td>
                <td class="py-4 px-6">{{ $user->created_at }}</td>
                <td class="py-4 pr-3">
                  <form action="{{ route ('deleteUser',['id' => $user->id]) }}" method="post" onsubmit="return confirm('削除しますか？')">
                    @csrf
                    <button type="hidden" type="submit" id="delete"><ion-icon name="close-circle"></ion-icon></button>
                    <input type="hidden" name='id' value="{{ $user->id }}">
                  </form>
                </td>
              @endforeach   
                </td>
              </tr>
            </tbody>
          </table>
    </div>

    
@include('medapp.flowbite')

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
@include('medapp.footer')
</html>