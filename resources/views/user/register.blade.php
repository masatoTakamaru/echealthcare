<x-guest-layout>
<section class="p-8 md:flex md:justify-center">
<div class="md:w-96">
    <h1>ユーザーの新規登録</h1>
    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('user.register') }}">
        @csrf

        <!-- Name -->
        <div class="flex">
            <div class="mr-2">
                <x-label for="last_name" value="姓" />
                <x-input class="block mt-1 w-full border p-2" type="text" name="last_name" :value="old('last_name')" required autofocus placeholder="例:吉本"/>
            </div>
            <div>
                <x-label for="first_name" value="名" />
                <x-input class="block mt-1 w-full border p-2" type="text" name="first_name" :value="old('first_name')" required placeholder="例:航汰"/>
            </div>
        </div>
        <div class="flex mt-4">
            <div class="mr-2">
                <x-label for="last_name_kana" value="姓フリガナ" />
                <x-input class="block mt-1 w-full border p-2" type="text" name="last_name_kana" :value="old('last_name_kana')" required autofocus placeholder="例:ヨシモト"/>
            </div>
            <div>
                <x-label for="first_name_kana" value="名フリガナ" />
                <x-input class="block mt-1 w-full border p-2" type="text" name="first_name_kana" :value="old('first_name_kana')" required placeholder="例:コウタ"/>
            </div>
        </div>
        <!-- phone -->
        <div>
            <x-label for="phone" value="電話番号" />
            <x-input class="block mt-1 w-full border p-2" type="text" name="phone" :value="old('phone')" required placeholder="例:0312345678(ハイフンなし)" />
        </div>
        <!-- zip -->
        <div>
            <x-label for="zip" value="郵便番号" />
            <x-input class="block mt-1 w-full border p-2" type="text" name="zip" :value="old('zip')" required placeholder="例:1980041(ハイフンなし7ケタ)"/>
        </div>
        <!-- address -->
        <div>
            <x-label for="address" value="住所" />
            <x-input class="block mt-1 w-full border p-2" type="text" name="address" :value="old('address')" required placeholder="東京都品川区二葉1500コーポ青山104号" />
        </div>
        <!-- Email Address -->
        <div class="mt-4">
            <x-label for="email" :value="__('Email')" />

            <x-input id="email" class="block mt-1 w-full border p-2" type="email" name="email" :value="old('email')" required placeholder="name@example.com" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-label for="password" :value="__('Password')" />

            <x-input id="password" class="block mt-1 w-full border p-2"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-input id="password_confirmation" class="block mt-1 w-full border p-2"
                            type="password"
                            name="password_confirmation" required />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('user.login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-button class="ml-4">
                {{ __('Register') }}
            </x-button>
        </div>
    </form>
</div>
</section>
</x-guest-layout>
