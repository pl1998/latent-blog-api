<?php

namespace App\Admin\Controllers;

use App\Models\Label;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class LabelController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\Label';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Label());

        $grid->column('id', __('Id'));
        $grid->column('label_name', __('Label name'));

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
        $show = new Show(Label::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('label_name', __('Label name'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Label());

        $form->text('label_name', __('Label name'));

        return $form;
    }
}
