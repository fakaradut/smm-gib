<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kullanıcılar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-full">
                    <h3 class="text-xl font-semibold mb-4">Kullanıcı Listesi</h3>
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">ID</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">İsim</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Email</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Şirket Adı</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">İşlem</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="border-t">
                                    <td class="px-4 py-2 text-sm text-gray-800">{{ $user->id }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-800">{{ $user->name }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-800">{{ $user->email }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-800">{{ $user->company_name }}</td>
                                    <td class="px-4 py-2 text-sm">
                                        {{-- <a href="{{ route('admin.users.edit', $user->id) }}"
                                            class="text-blue-500 hover:text-blue-700">Düzenle</a> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Add more sections if needed -->
        </div>
    </div>
</x-app-layout>
