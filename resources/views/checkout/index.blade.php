<x-guest-layout>
@if(Auth::id())
    <div class="m-4">
        <h1>注文内容を確認・変更する</h1>
        <section>
            <h2>お届け先住所</h2>
        </section>
        <section>
            <h2>支払方法</h2>
        </section>
        <section>
            <div class="placeYourOrder">
                <a class="" href="#">注文を確定する</a>
            </div>
        </section>
    </div>
@else
    <section class="m-4">
        <div class="font-alert">
            ログインしていません。
        </div>
        <div class="font-alert">
            ログインまたはユーザー登録してください。
        </div>
    </section>
    <section class="mt-8">
        <div class="text-center mb-8">
            <a class="bg-primary py-2 px-10 rounded-lg shadow" href="{{ route('login') }}">ログイン</a>
        </div>
        <div class="text-center mb-8">
            <a class="py-2 px-8 border-2 rounded-lg shadow" href="{{ route('register') }}">新規登録</a>
        </div>
    </section>
@endif
</x-guest-layout>