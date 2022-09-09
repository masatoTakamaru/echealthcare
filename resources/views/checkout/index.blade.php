<x-guest-layout>
@if(Auth::id())
    <div class="m-4">
        <h1 class="my-4">注文内容を確認・変更する</h1>
        <section class="my-4">
            <h2 class="my-2">お届け先住所</h2>
            <div class="mx-4">
                <p>{{ $user->last_name }}&nbsp;{{ $user->first_name }}</p>
                <p>{{ sprintf('%s-%s', mb_substr($user->zip, 0, 3),mb_substr($user->zip, 3, 4)) }}</p>
                <p>{{ $user->address }}</p>
                <p>電話番号&nbsp;:&nbsp;{{ $user->phone }}</p>
            </div>
        </section>
        <section>
            <h2 class="my-2">支払方法</h2>
            <form class="mx-4" action="" method="POST">
                @csrf

                <p>以下からお選び下さい</p>
                {{-- way of payment --}}
                <section class="border p-2">
                    <h2 class="text-sm">お支払い方法</h2>
                    <div class="flex flex-wrap items-center">
                        <img class="mx-4" src="{{ asset('icons/settlements/visa.svg') }}">
                        <img class="mx-4" src="{{ asset('icons/settlements/master.svg') }}">
                        <img class="mx-4" src="{{ asset('icons/settlements/jcb.webp') }}">
                        <img class="mx-4" src="{{ asset('icons/settlements/paypay.webp') }}">
                        <img class="mx-4" src="{{ asset('icons/settlements/rakutenpay.webp') }}">
                    </div>
                </section>

                <p class="my-4">クレジットカード</p>
                <label class="block" for="creditcard-number">カード番号</label>
                <input class="p-2 border rounded" type="number" name="creditcard-number" value="{{ old('creditcard-number') }}" placeholder="例: 5172005498840990">
                <label class="block" for="creditcard-number">カードの名義人</label>
                <div class="flex">
                    <input class="w-5/12 p-2 mr-1 border rounded" type="text" name="creditcard-firstname" value="{{ old('creditcard-firstname') }}" placeholder="例: TARO">
                    <input class="w-5/12 p-2 border rounded" type="text" name="creditcard-lastname" value="{{ old('creditcard-lastname') }}" placeholder="例: TANAKA">
                </div>
                <label class="block" for="creditcard-expiredmonth">カードの有効期限</label>
                <div class="flex mb-8">
                    <input class="w-3/12 p-2 mr-1 border rounded" type="number" name="creditcard-expiredmonth" value="{{ old('creditcard-expiredmonth') }}" placeholder="例: 04">
                    <input class="w-3/12 p-2 border rounded" type="number" name="creditcard-expiredyear"  value="{{ old('creditcard-expiredyear') }}" placeholder="例: 27">
                </div>
                <span class="bg-primary py-2 px-8 rounded-lg shadow">
                    <input type="submit" value="注文を確定する">
                </span>
            </form>
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
            <a class="bg-primary py-2 px-10 rounded-lg shadow" href="{{ route('user.login') }}">ログイン</a>
        </div>
        <div class="text-center mb-8">
            <a class="py-2 px-8 border-2 rounded-lg shadow" href="{{ route('user.register') }}">新規登録</a>
        </div>
    </section>
@endif
</x-guest-layout>