<?php
use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;
use Zizaco\Entrust\HasRole;
use Laravel\Cashier\BillableTrait;
use Laravel\Cashier\BillableInterface;

class User extends Eloquent implements ConfideUserInterface, BillableInterface {
    use ConfideUser, HasRole, BillableTrait;

    protected $dates = ['trial_ends_at', 'subscription_ends_at'];

    public function stories()
    {
        return $this->hasMany('Story');
    }
}
