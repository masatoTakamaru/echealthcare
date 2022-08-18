<x-guest-layout>
<section class="p-8 md:flex md:justify-center">
    <div class="md:w-96">
        <h1 class="my-4">登録情報の編集</h1>
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form action="{{ route('user.update', ['user' => $user->id]) }}" method="POST">
            @method('PUT')
            @csrf

            <!-- Name -->
            <div class="flex">
                <div class="mr-2">
                    <x-label for="last_name" value="姓" />
                    <x-input class="block mt-1 w-full border p-2" type="text" name="last_name" :value="old('last_name') ?? $user->last_name" required autofocus />
                </div>
                <div>
                    <x-label for="first_name" value="名" />
                    <x-input class="block mt-1 w-full border p-2" type="text" name="first_name" :value="old('first_name') ?? $user->first_name" required />
                </div>
            </div>
            <div class="flex mt-4">
                <div class="mr-2">
                    <x-label for="last_name_kana" value="姓フリガナ" />
                    <x-input class="block mt-1 w-full border p-2" type="text" name="last_name_kana" :value="old('last_name_kana') ?? $user->last_name_kana" required autofocus />
                </div>
                <div>
                    <x-label for="first_name_kana" value="名フリガナ" />
                    <x-input class="block mt-1 w-full border p-2" type="text" name="first_name_kana" :value="old('first_name_kana') ?? $user->first_name_kana" required />
                </div>
            </div>
            <!-- phone -->
            <div>
                <x-label class="mt-4" for="phone" value="電話番号" />
                <x-input class="block mt-1 w-1/2 border p-2" type="text" name="phone" :value="old('phone') ?? $user->phone" required />
            </div>
            <!-- zip -->
            <div>
                <x-label class="mt-4" for="zip" value="郵便番号" />
                <x-input class="block mt-1 w-1/3 border p-2" type="text" name="zip" :value="old('zip') ?? $user->zip" required />
            </div>
            <!-- address -->
            <div>
                <x-label class="mt-4" for="address" value="住所" />
                <x-input class="block mt-1 w-full border p-2" type="text" name="address" :value="old('address') ?? $user->address" required />
            </div>
            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full border p-2" type="email" name="email" :value="old('email') ?? $user->email" required />
            </div>
            <div class="text-center mt-8">
                <span class="bg-primary py-2 px-8 rounded shadow">
                    <input type="submit" value="更新">
                </span>
            </div>
        </form>
    </div>
</section>
</x-guest-layout>