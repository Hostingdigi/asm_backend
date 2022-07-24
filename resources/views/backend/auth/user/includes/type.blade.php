@if ($user->isAdmin())
    @lang('Administrator')
@elseif ($user->isUser())
    @role('user')
        Customer
    @else
        Supplier
    @endrole
    <!-- @lang('User') -->
@else
    @lang('N/A')
@endif
