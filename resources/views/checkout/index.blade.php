<x-guest-layout>
<section>
    <div class="section-inner">
        <h1>注文内容を確認・変更する</h1>
        <div>
            <h1>お届け先住所</h1>
            <p>{{ $user->last_name }}&nbsp;{{ $user->first_name }}</p>
            <p>〒{{ sprintf('%s-%s', mb_substr($user->zip, 0, 3), mb_substr($user->zip, 3, 4)) }}</p>
            <p>{{ $user->address }}</p>
        </div>
    </div>
</section>
<section>
    <div class="section-inner">
        <h1>支払方法</h1>
        <p>以下からお選び下さい</p>
        <div class="boxed">
            <div class="way-of-payment">
                <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="40px" height="40px"><path fill="#1565C0" d="M45,35c0,2.209-1.791,4-4,4H7c-2.209,0-4-1.791-4-4V13c0-2.209,1.791-4,4-4h34c2.209,0,4,1.791,4,4V35z"/><path fill="#FFF" d="M15.186 19l-2.626 7.832c0 0-.667-3.313-.733-3.729-1.495-3.411-3.701-3.221-3.701-3.221L10.726 30v-.002h3.161L18.258 19H15.186zM17.689 30L20.56 30 22.296 19 19.389 19zM38.008 19h-3.021l-4.71 11h2.852l.588-1.571h3.596L37.619 30h2.613L38.008 19zM34.513 26.328l1.563-4.157.818 4.157H34.513zM26.369 22.206c0-.606.498-1.057 1.926-1.057.928 0 1.991.674 1.991.674l.466-2.309c0 0-1.358-.515-2.691-.515-3.019 0-4.576 1.444-4.576 3.272 0 3.306 3.979 2.853 3.979 4.551 0 .291-.231.964-1.888.964-1.662 0-2.759-.609-2.759-.609l-.495 2.216c0 0 1.063.606 3.117.606 2.059 0 4.915-1.54 4.915-3.752C30.354 23.586 26.369 23.394 26.369 22.206z"/><path fill="#FFC107" d="M12.212,24.945l-0.966-4.748c0,0-0.437-1.029-1.573-1.029c-1.136,0-4.44,0-4.44,0S10.894,20.84,12.212,24.945z"/></svg>
                <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="40px" height="40px"><path fill="#ff9800" d="M32 10A14 14 0 1 0 32 38A14 14 0 1 0 32 10Z"/><path fill="#d50000" d="M16 10A14 14 0 1 0 16 38A14 14 0 1 0 16 10Z"/><path fill="#ff3d00" d="M18,24c0,4.755,2.376,8.95,6,11.48c3.624-2.53,6-6.725,6-11.48s-2.376-8.95-6-11.48 C20.376,15.05,18,19.245,18,24z"/></svg>
                <img src="{{ asset('icons/settlements/jcb.webp') }}">
                <img src="{{ asset('icons/settlements/paypay.webp') }}">
                <img src="{{ asset('icons/settlements/rakutenpay.webp') }}">
            </div>
        </div>
    </div>
</section>
<section>
    <div class="section-inner">
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
    </div>
</section>
</x-guest-layout>