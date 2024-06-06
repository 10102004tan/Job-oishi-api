<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl">
            <h1 class="text-center font-bold text-xl">New Notification</h1>
            <form method="POST" action="{{route('notifications.store')}}" class="mt-10">
                @csrf
                <div class="mb-5">
                    <label for="title" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                        Title
                    </label>
                    <input type="text" class="border border-gray-400 p-2 w-full" name="title" id="title" required>
                </div>
                <div class="mb-5">
                    <label for="body" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                        Description body
                    </label>
                    <input type="text" class="border border-gray-400 p-2 w-full" name="body" id="body" required>
                </div>

                <div class="mb-5">
                        <select name="type" id="type" class="border border-gray-400 p-2 w-full" required>
                            <option value="1">Người dùng mới</option>
                            <option value="2">Người tất cả người dùng</option>
                            <option value="3">Người dùng tùy chọn</option>
                        </select>
                </div>

                <div class="users hidden">
                    <table>
                        <tr>
                            <th>Chọn</th>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                        @foreach($users as $user)
                        <tr>
                            <td><input type="checkbox" name="users[]" value="{{$user->id}}"></td>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="mb-5">
                    <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">
                        Submit
                    </button>
                </div>
            </form>
        </main>
    </section>
    <script>
        const type = document.getElementById('type');
        const users = document.querySelector('.users');
        type.addEventListener('change', function() {
            if (type.value == 3) {
                users.style.display = 'block';
            } else {
                users.style.display = 'none';
            }
        });
    </script>
</x-layout>