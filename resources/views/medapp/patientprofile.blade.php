<!DOCTYPE html>
<html lang="en">
@include("medapp.head")
<body class="min-h-screen bg-gray-100 dark:bg-gray-800">
    @include("medapp.header")
<div class="flex flex-col mb-6">
    <div class="container mx-auto px-4 block sm:flex sm:justify-center">
            <div class="my-4 sm:mx-2 w-full max-w-auto sm:max-w-md bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-end px-4 pt-4">
                </div>
                <form action="{{ route('pictureUpdate', Auth::User()->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col items-center pb-10">
                    @if(Auth::User()->profile_photo_path === NULL)
                        <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ asset('default.png') }}" alt="プロフィール画像"/>
                    @else
                        <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ Storage::url(Auth::User()->profile_photo_path) }}" alt="プロフィール画像"/>
                    @endif    
                        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ Auth::User()->name }}</h5>
                        <p class="text-gray-500 dark:text-gray-400 mt-0 mb-2">患者ID: {{ Auth::User()->id }}</p>
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
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">担当医師一覧</h5>
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
                                    担当医師一覧
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="staticModal">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                                </button>
                            </div>
                            <!-- モーダルボディー -->
                            <div class="flow-root px-4">
                                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($mydoctors as $doc)
                                    <li class="py-3 sm:py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                @if($doc->profile_photo_path === NULL)
                                                    <img class="w-12 h-12 mb-3 rounded-full shadow-lg overflow-hidden" src="{{ asset('default.png') }}" alt="プロフィール画像"/>
                                                @else
                                                    <img class="w-12 h-12 mb-3 rounded-full shadow-lg overflow-hidden" src="{{ Storage::url($doc->profile_photo_path) }}" alt="プロフィール画像"/>
                                                @endif    
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                    {{ $doc->name }}先生
                                                </p>
                                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                    {{ $doc->email }}
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
                        @foreach($mydoctors as $doc)
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    @if($doc->profile_photo_path === NULL)
                                        <img class="w-12 h-12 mb-3 rounded-full shadow-lg overflow-hidden" src="{{ asset('default.png') }}" alt="プロフィール画像"/>
                                    @else
                                        <img class="w-12 h-12 mb-3 rounded-full shadow-lg overflow-hidden" src="{{ Storage::url($doc->profile_photo_path) }}" alt="プロフィール画像"/>
                                    @endif    
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        {{ $doc->name }}先生
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        {{ $doc->email }}
                                    </p>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
    </div>
    <div class="container px-4 mx-auto sm:flex sm:justify-center">
        <div class="sm:mx-2 sm:min-w-[782px] p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">退会する</h5>
            </a>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 mt-3">クスリマインダーから退会します。</br> 退会処理を行うと、登録済みのプロフィールや薬袋の中身など、すべてが削除されます。
            </p>
            <button class="block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" type="button" data-modal-toggle="popup-modal">
               退会する
            </button>
            <div id="popup-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                <form action="{{ route("taikai") }}" method="POST">
                    @csrf
                    <div class="relative w-full h-full max-w-md md:h-auto">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="popup-modal">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-6 text-center">
                                <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">「退会する」のボタンを押すと、</br> 退会が完了します。</br> 本当に退会してもよろしいですか？</h3>
                                <button type="submit" data-modal-toggle="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                    退会する
                                </button>
                                <button data-modal-toggle="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">キャンセル</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
@include("medapp.footer")
@include("medapp.flowbite")
</html>