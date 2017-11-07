{{ Lang::get('confide::confide.email.account_confirmation.greetings', array('name' => $user['username'])) }},<br/>
<br/>
Please confirm your email address by clicking on this link:<br/><br/>
<a href='{{{ URL::to("users/confirm/{$user['confirmation_code']}") }}}'>
    {{{ URL::to("users/confirm/{$user['confirmation_code']}") }}}
</a><br/>
<br/>
After you verify your account, you can login and start having fun :-)
<br/><br/>
Wishing you much joy in your creation,<br/>
Mike<br/>

