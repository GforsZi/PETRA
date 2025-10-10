@foreach ($users as $user)
    {{ $user->usr_card_url }}
    {{ $user->name }}
    {{ $user->usr_no_wa }}
    {{ $user->roles->rl_name }}
    {{ $user->usr_created_at->format('d M Y') }}
@endforeach
