<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Carbon\Carbon;
use App\Admin\Actions\Post\BatchRestore;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('Id'))->filter();
        $grid->column('name', __('Name'))->filter('like');
        $grid->column('email', __('Email'))->filter('like'); 
        $grid->column('username', __('Username'))->filter('like');
        $grid->column('points', __('Points'))->filter(); 
        $grid->column('avatar', __('Avatar'))->image(80,80);
        $grid->column('created_at', __('Created At'))->display(function ($created_at) {
            return Carbon::parse($created_at)->setTimeZone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s');
        })->filter('date');
        // $grid->column('email_verified_at', __('Email verified at'));
        // $grid->column('password', __('Password'));
        // $grid->column('remember_token', __('Remember token'));
        // $grid->column('updated_at', __('Updated at'));
        // $grid->column('website_link', __('Website link'));
        // $grid->column('bio', __('Bio'));
        // $grid->column('reset_password_token', __('Reset password token'));
        // $grid->column('role_id', __('Role id'));

        $grid->disableCreateButton();
        $grid->actions(function ($actions) {
            $actions->disableEdit();
            $actions->disableView();
            if (\request('_scope_') == 'trashed') {
                $actions->disableDelete();
            }
        });
        $grid->filter(function($filter) {
            $filter->scope('trashed', 'Recycle Bin')->onlyTrashed();
            $filter->disableIdFilter();
        });
        $grid->batchActions (function($batch) {
            if (\request('_scope_') == 'trashed') {
                $batch->add(new BatchRestore());
            }
        });
        
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('email_verified_at', __('Email verified at'));
        $show->field('password', __('Password'));
        $show->field('remember_token', __('Remember token'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('avatar', __('Avatar'));
        $show->avatar()->image();
        $show->field('website_link', __('Website link'));
        $show->field('bio', __('Bio'));
        $show->field('points', __('Points'));
        $show->field('reset_password_token', __('Reset password token'));
        $show->field('role_id', __('Role id'));
        $show->field('username', __('Username'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User());

        $form->text('name', __('Name'));
        $form->email('email', __('Email'));
        $form->datetime('email_verified_at', __('Email verified at'))->default(date('Y-m-d H:i:s'));
        $form->password('password', __('Password'));
        $form->text('remember_token', __('Remember token'));
        $form->textarea('avatar', __('Avatar'));
        $form->text('website_link', __('Website link'));
        $form->text('bio', __('Bio'));
        $form->number('points', __('Points'));
        $form->text('reset_password_token', __('Reset password token'));
        $form->number('role_id', __('Role id'))->default(1);
        $form->text('username', __('Username'));

        return $form;
    }
}
