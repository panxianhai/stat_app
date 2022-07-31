<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Visit;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class VisitController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Visit(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('domain')->filter();
            $grid->column('refer', '来源')->limit(30);
            $grid->column('ip_address');
            $grid->column('click_type', '统计类型')->display(function ($click_type) {
                switch ($click_type) {
                    case 1:
                        return '首页';
                    case 2:
                        return '按钮1';
                    case 3:
                        return '按钮2-英文';
                }
            })->filter();
            $grid->column('date')->filter();
            $grid->column('created_at')->display(function ($created_at) {
                return date('Y-m-d H:i:s', strtotime($created_at));
            });

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('domain');

            });
            $grid->model()->orderBy('id', 'desc');
            $grid->disableCreateButton();
            $grid->disableActions();
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Visit(), function (Show $show) {
            $show->field('id');
            $show->field('domain');
            $show->field('refer');
            $show->field('ip_address');
            $show->field('click_type');
            $show->field('date');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Visit(), function (Form $form) {
            $form->display('id');
            $form->text('domain');
            $form->text('refer');
            $form->text('ip_address');
            $form->text('click_type');
            $form->text('date');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
