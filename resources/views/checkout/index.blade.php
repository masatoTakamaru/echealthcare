<x-guest-layout>
<article>
    <h1 class="article-header">注文内容を確認・変更する</h1>
    <section>
        <h1>お届け先住所</h1>
        <p>{{ $user->last_name }}&nbsp;{{ $user->first_name }}</p>
        <p>〒{{ sprintf('%s-%s', mb_substr($user->zip, 0, 3), mb_substr($user->zip, 3, 4)) }}</p>
        <p>{{ $user->address }}</p>
    </section>
    <section>
        <h1>支払方法</h1>
        <p>以下からお選び下さい</p>
        {{-- way of payment --}}
        <div class="boxed">
            <div class="way-of-payment">
                <img src="{{ asset('icons/settlements/visa.svg') }}">
                <img src="{{ asset('icons/settlements/master.svg') }}">
                <img src="{{ asset('icons/settlements/jcb.webp') }}">
                <img src="{{ asset('icons/settlements/paypay.webp') }}">
                <img src="{{ asset('icons/settlements/rakutenpay.webp') }}">
            </div>
        </div>
    </section>
    <section>
        <form action="" method="POST">
            @csrf
            <h1>クレジットカード</h1>
            <p><label for="creditcard-number">カード番号</label></p>
            <input type="number" name="creditcard-number" value="{{ old('creditcard-number') }}" placeholder="例: 5172005498840990">
            <p><label for="creditcard-number">カードの名義人</label></p>
            <input type="text" name="creditcard-firstname" value="{{ old('creditcard-firstname') }}" placeholder="例: TARO">
            <input type="text" name="creditcard-lastname" value="{{ old('creditcard-lastname') }}" placeholder="例: TANAKA">
            <p><label class="block" for="creditcard-expiredmonth">カードの有効期限</label></p>
            <input type="number" name="creditcard-expiredmonth" value="{{ old('creditcard-expiredmonth') }}" placeholder="例: 04">
            <input type="number" name="creditcard-expiredyear"  value="{{ old('creditcard-expiredyear') }}" placeholder="例: 27">
            <div class="centered">
                <button class="btn-primary">
                    <input type="submit" value="注文を確定する">
                </button>
            </div>
        </form>
    </section>
</article>
</x-guest-layout>