<?php

namespace App\Admin\Controllers;

use App\Models\Subscriptions;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SubscriptionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Subscriptions';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Subscriptions());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('user_id', __('User id'))->sortable();
        $grid->column('name', __('Name'));
        $grid->column('stripe_id', __('Stripe id'));
        $grid->column('stripe_status', __('Stripe status'));
        $grid->column('stripe_price', __('Stripe price'));
        $grid->column('quantity', __('Quantity'));
        $grid->column('trial_ends_at', __('Trial ends at'));
        $grid->column('ends_at', __('Ends at'));
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();;
        $grid->column('price_total', __('Price total'));

        $grid->filter(function($filter) {
            $filter->disableIdFilter();
            $filter->equal('identifier', 'ID');
            $filter->equal('user_id', 'User ID');
            $filter->between('created_at', '登録日')->datetime();
        });

        $grid->disableCreateButton();
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();
        });

        return $grid;
    }

   
   
}
