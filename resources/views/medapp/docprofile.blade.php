<!DOCTYPE html>
<html lang="en">
@include("medapp.head")
<body class="min-h-screen bg-gray-100 dark:bg-gray-800">
    @include("medapp.header")
<div class="flex flex-col mb-6">
    <div class="container mx-auto px-4 block sm:flex sm:justify-center">
            <div class="my-4 sm:mx-2 w-full max-w-auto sm:max-w-md bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                <form action="{{ route('pictureUpdate', Auth::User()->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col items-center pb-10 my-4">
                    @if(Auth::User()->profile_photo_path === NULL)
                        <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ asset('default.png') }}" alt="プロフィール画像"/>
                    @else
                        <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ Storage::url(Auth::User()->profile_photo_path) }}" alt="プロフィール画像"/>
                    @endif    
                        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ Auth::User()->name }}</h5>
                        <span class="text-sm text-gray-500 dark:text-gray-400 mt-1 mb-3">{{ Auth::User()->email }}</span>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">プロフィール画像をアップロード</label>
                        <input accept='image/png, image/jpeg, image/jpg' class="max-w-[280px] block w-auto text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="profile_photo" name="profile_photo" type="file">
                        <div class="flex justify-between">
                            <button type="submit" class="mt-3 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">アップロード</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="my-4 sm:mx-2 w-full max-w-auto sm:max-w-md p-4 bg-white border rounded-lg shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">患者一覧</h5>
                    <a href="#" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500" data-modal-toggle="staticModal">
                        すべて表示
                    </a>
                </div>
                <div id="staticModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                    <div class="relative w-full h-full max-w-2xl md:h-auto">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    患者一覧
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="staticModal">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                                </button>
                            </div>
                            <!-- モーダルボディ -->
                            <div class="flow-root px-4">
                                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700 overflow-y-auto">
                                    @foreach($mypatients as $pat)
                                    <li class="py-3 sm:py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                @if($pat->profile_photo_path === NULL)
                                                    <img class="w-12 h-12 mb-3 rounded-full shadow-lg overflow-hidden" src="{{ asset('default.png') }}" alt="プロフィール画像"/>
                                                @else
                                                    <img class="w-12 h-12 mb-3 rounded-full shadow-lg overflow-hidden" src="{{ Storage::url($pat->profile_photo_path) }}" alt="プロフィール画像"/>
                                                @endif    
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                    {{ $pat->name }}さん
                                                </p>
                                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                    {{ $pat->email }}
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flow-root">
                    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($mypatients as $info)
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    @if($info->profile_photo_path === NULL)
                                        <img class="w-12 h-12 mb-3 rounded-full shadow-lg overflow-hidden max-w-xs" src="{{ asset('default.png') }}" alt="プロフィール画像"/>
                                    @else
                                        <img class="w-12 h-12 mb-3 rounded-full shadow-lg overflow-hidden" src="{{ Storage::url($info->profile_photo_path) }}" alt="プロフィール画像"/>
                                    @endif    
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        <a href="#">{{ $info->name }}さん</a>
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        {{ $info->email }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                        </li>
                    </ul>
                </div>
            </div>
    </div>
    <div class="container px-4 mx-auto sm:flex sm:justify-center">
        <div class="sm:mx-2 sm:min-w-[782px] sm:max-w-[782px] p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">患者を追加</h5>
            </a>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 mt-3">患者を追加すると、患者の薬袋に新しい薬の追加、既存の薬の編集・削除が可能になります。患者・医師関係になると、一部の個人情報が共有されるので、患者を追加する際に患者IDに間違いのようにご注意ください。
            </p>
            <form action="{{ route('addPatient')}}" method="post" class="sm:flex">
                @csrf
                <input type="text" name="patient_id" class="w-full mb-4 sm:mb-0 block sm:flex-auto sm:mr-4 max-h-[42px] bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block sm:w-auto pl-3 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="患者ID">
                <button onsubmit="return confirm('このユーザを患者として追加しますか？')"id="submit" type="submit" class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800">
                    <span class="font-bold relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                      追加
                    </span>
                  </button>
            </form>
        </div>
    </div>
</div>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
@include("medapp.footer")
@include("medapp.flowbite")
</html>