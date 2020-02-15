<?php

namespace App\Admin\Controllers;

use App\Models\Topic;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TopicController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\Topic';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Topic());

        $grid->column('id', __('Id'));
        $grid->column('topic_id', __('Topic id'));
        $grid->column('category_id', __('Category id'));
        $grid->column('user_id', __('User id'));
        $grid->column('to_uid', __('To uid'));
        $grid->column('content', __('Content'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Topic::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('topic_id', __('Topic id'));
        $show->field('category_id', __('Category id'));
        $show->field('user_id', __('User id'));
        $show->field('to_uid', __('To uid'));
        $show->field('content', __('Content'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Topic());

        $form->number('topic_id', __('Topic id'));
        $form->number('category_id', __('Category id'));
        $form->number('user_id', __('User id'));
        $form->number('to_uid', __('To uid'));
        $form->textarea('content', __('Content'));

        return $form;
    }
}
