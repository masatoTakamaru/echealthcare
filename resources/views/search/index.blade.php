<x-guest-layout>
<section>
<form action="{{ route('user.search') }}" method="POST">
    @csrf
    
</form>
</section>
</x-guest-layout>
