<x-guest-layout>
<section>
    <h1>登録情報の編集</h1>
    <form action="route('user.update', ['user' => $user->id])" method="POST">
        @method('PUT')
        @csrf

    </form>
</section>
</x-guest-layout>