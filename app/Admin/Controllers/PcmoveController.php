<?php

namespace App\Admin\Controllers;

use App\Models\Pcmove;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class PcmoveController extends AdminController
{
    protected $title = 'App\Models\Pcmove';

    public function index(Content $content)
    {
        return $content
            ->header('我的电影')
            ->description('列表')
            ->body($this->grid());
    }

    protected function grid()
    {
        $movtype = [
            5 => '欧美',
            8 => '国产',
            9 => '中文字幕',
            16 => '亚洲无码',
        ];
        $grid = new Grid(new Pcmove());

//        $grid->column('id', __('Id'));
        $grid->column('movname', __('Movname'));
//        $grid->column('movurl', __('Movurl'));
        $grid->column('picurl','图片')->image();
        $grid->column('torrenturl', 'Torrenturl')->link();
//        $grid->column('type', __('Type'));

        $grid->filter(function($filter) use ($movtype) {
            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            $filter->equal('type')->select($movtype);
            $filter->like('movname','关键字');
        });
        $grid->disableActions();
        $grid->disableCreateButton();
        $grid->disableRowSelector();
        $grid->disableColumnSelector();

        return $grid;
    }

    protected function detail($id)
    {
        $show = new Show(Pcmove::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('movname', __('Movname'));
        $show->field('movurl', __('Movurl'));
        $show->field('picurl', __('Picurl'));
        $show->field('torrenturl', __('Torrenturl'));
        $show->field('type', __('Type'));

        return $show;
    }

    protected function form()
    {
        $form = new Form(new Pcmove());

        $form->text('movname', __('Movname'));
        $form->text('movurl', __('Movurl'));
        $form->text('picurl', __('Picurl'));
        $form->text('torrenturl', __('Torrenturl'));
        $form->number('type', __('Type'));

        return $form;
    }
}
