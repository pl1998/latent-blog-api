<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ArticleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '文章列表';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Article());

        $grid->column('category_id', __('Category id'));
        $grid->column('user_id', __('User id'));
        $grid->column('title', __('Title'));
        $grid->column('cover_img', __('Cover img'));
        $grid->column('description', __('Description'));
        $grid->column('content', __('Content'));
        $grid->column('review_count', __('Review count'));
        $grid->column('browse_count', __('Browse count'));
        $grid->column('label_id', __('Label id'));
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
        $show = new Show(Article::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('category_id', __('Category id'));
        $show->field('user_id', __('User id'));
        $show->field('title', __('Title'));
        $show->field('cover_img', __('Cover img'));
        $show->field('description', __('Description'));
        $show->field('content', __('Content'));
        $show->field('review_count', __('Review count'));
        $show->field('browse_count', __('Browse count'));
        $show->field('label_id', __('Label id'));
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
        $form = new Form(new Article());

        $form->number('category_id', __('Category id'));
        $form->number('user_id', __('User id'));
        $form->text('title', __('Title'));
        $form->text('cover_img', __('Cover img'));
        $form->text('description', __('Description'));
        $form->textarea('content', __('Content'));
        $form->number('review_count', __('Review count'));
        $form->number('browse_count', __('Browse count'));
        $form->number('label_id', __('Label id'));

        return $form;
    }
}
